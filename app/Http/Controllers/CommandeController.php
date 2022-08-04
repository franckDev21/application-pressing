<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommandeResource;
use App\Http\Resources\CommandeRessourceEdit;
use App\Models\Commande;
use App\Models\TypeVetement;
use App\Models\Vetement;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::latest()->with(['client','vetements'])->paginate(6);
        return view('commandes.index',compact('commandes'));
    }

    public function indexApi(){
        $commandes = Commande::latest()->with(['client','vetements'])->get();

        $commandesTable = [];
        
        foreach ($commandes as $commande) {
            $commandesTable[] = [
                'quantite_total_vetement' => $commande->vetements->sum('quantite'),
                'commande' => $commande,
                'date_exp' => $commande->date_livraison->format('d M Y')
            ];
        }

        return $commandesTable;
    }

    public function vetements(Request $request,Commande $commande){
        $typeVetements = TypeVetement::all();
        return view('commandes.vetements',compact('commande','typeVetements'));
    }

    public function vetementDelete(Request $request,Commande $commande,Vetement $vetement){
        // supprimer le vetement
        $vetement->delete();

        $commande = Commande::findOrFail($commande->id);

        $cout_total = 0;
        // On recalcule la cout total de la commande
        foreach ($commande->vetements as $vet) {
            $cout_total += $this->multiplication($vet->quantite,$vet->prix_unitaire);
        }

        // update de la commande
        $commande->cout_total = $cout_total;
        $commande->save();

        Session::flash('success'," vêtement supprimé !");
        return back();
    }

    public function vetementStore(Request $request){
        $data = $request->validate([
            "vetement_id"       => "required",
            "type_vetement_id"  => "required",
            "statut"            => "required",
            "service_demander"  => "required",
            "quantite" => 'required'
        ]);

        $vetement = Vetement::findOrFail($request->vetement_id);
        $vetement->update($data);

        $cout_total = 0;
        // On recalcule la cout total de la commande
        foreach ($vetement->commande->vetements as $vet) {
            $cout_total += $this->multiplication($vet->quantite,$vet->prix_unitaire);
        }

        // update de la commande
        $commande = Commande::findOrFail($vetement->commande->id);
        $commande->cout_total = $cout_total;
        $commande->save();

        Session::flash('success',"La mise du vêtement à été éfféctuer avec succès !");
        return back();
    }

    private function multiplication(int $qte,int $pu) {
        return $qte * $pu;
    }

    public function vetementTypeApi(){
        $vetementTypes = TypeVetement::all();
        return response()->json($vetementTypes);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commandes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // on crée la commande
        $data = $request->commande;
        $commande = Commande::create($data);

        
        // on sauvegarder les vêtements de la commande
        foreach($request->vetements as $vetement){
            if($vetement['qte'] !== 0 && $vetement['prix_unitaire'] !== 0){
                Vetement::create([
                    'type_vetement_id' => $vetement['type_vetement_id'],
                    'commande_id' => $commande->id,
                    'quantite' => $vetement['qte'],
                    'prix_unitaire' => $vetement['prix_unitaire']
                ]);
            }
        }

        return response()->json([
            'success' => 'success',
            'commande_id' => $commande->id
        ]);
    }

    public function payer(Request $request,Commande $commande){
        $commande->update([
            'etat' => 'SOLDER'
        ]);

        Session::flash('success',"Commande payé !");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        return view('commandes.edit',compact('commande'));
    }

    public function showApi(Request $request,Commande $commande){
        return response()->json([
            'commande' => $commande,
            'vetements' => $commande->vetements,
            'date_format' => $commande->date_livraison->format('Y-m-d')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        // on met a jour la commande
        $commande->update($request->commande);

        // on parcours les vetements
        foreach($request->vetements as $vetement){
            // on verifie grace a l'id si le vetement se trouve en BD
            $vetementDB = Vetement::find($vetement['id']);

            if($vetement['qte'] !== 0 && $vetement['prix_unitaire'] !== 0){
                if($vetementDB){ // si oui on le modifie
                    $vetementDB->update([
                        'quantite' => $vetement['qte'],
                        'prix_unitaire' => $vetement['prix_unitaire'],
                        'type_vetement_id' => $vetement['type_vetement_id']
                    ]);
                }else{ // sinon en l'enregistre
                    Vetement::create([
                        'type_vetement_id' => $vetement['type_vetement_id'],
                        'commande_id' => $commande->id,
                        'quantite' => $vetement['qte'],
                        'prix_unitaire' => $vetement['prix_unitaire']
                    ]);
                }
            }
            
        }

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
