<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommandeResource;
use App\Http\Resources\CommandeRessourceEdit;
use App\Mail\FactureMail;
use App\Models\Caisse;
use App\Models\CaisseTotal;
use App\Models\Client;
use App\Models\Commande;
use App\Models\TypeVetement;
use App\Models\Vetement;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $newCommande = $commande = Commande::create($data);

        // on met a jour la caisse
        Caisse::create([
            'user_id' => auth()->user()->id,
            'type'    => 'ENTRER',
            'motif'   => 'Nouvelle commande',
            'montant' => (int)$data['cout_total'],
            'commande_id' => $newCommande->id
        ]);

        $caisse = CaisseTotal::first();

        $total = 0;

        if($caisse){
            $total = $caisse->sum('montant');

            $caisse->update([
                'montant' => (int)$total + (int)$request->commande['cout_total']
            ]);
        }else{
            CaisseTotal::create([
                'montant' => (int)$total + (int)$request->commande['cout_total']
            ]);
        }

        // on sauvegarder les vêtements de la commande
        foreach($request->vetements as $vetement){
            if($vetement['qte'] !== 0){
                if(isset($vetement['action']) && $vetement['action'] !== 'delete'){

                    if( Str::contains($request->commande['type_lavement']['name'],'piece') ){
                        $prix_unitaire = $vetement['prix_unitaire'];
                        if($prix_unitaire !== 0){
                            Vetement::create([
                                'type_vetement_id' => $vetement['type_vetement_id'],
                                'commande_id' => $commande->id,
                                'quantite' => $vetement['qte'],
                                'prix_unitaire' => $prix_unitaire
                            ]);
                        }
                    }else{
                        Vetement::create([
                            'type_vetement_id' => $vetement['type_vetement_id'],
                            'commande_id' => $commande->id,
                            'quantite' => $vetement['qte'],
                            'prix_unitaire' => null
                        ]);
                    }

                    
                }
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
        $commande->typeLavage;
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
        // on garde la valeur de l'ancienne commande
        $old_commande = clone $commande;

        // on met a jour la commande
        $commande->update($request->commande);
        $new_commande = Commande::findOrFail($commande->id);

        # Mise a jour de la caisse
        // on recupere le cout total de l'ancienne commande avant l'update
        $cout_total_ancienne_commande = $old_commande->cout_total;

        $caisse =  Caisse::where('commande_id',$old_commande->id)->first();

        if($caisse){
            $caisse->update([
                'montant' => $new_commande->cout_total
            ]);
        }

        $caisseTotal = CaisseTotal::first();

        $total = 0;

        if($caisseTotal){
            //  on retire l'ancien montant de la commande en caisse total
            $total = (int)$caisseTotal->sum('montant') - (int)$cout_total_ancienne_commande;

            // on ajoute au total le cout de la commande mise a jour
            $total += (int)$new_commande->cout_total;

            $caisseTotal->update([
                'montant' => $total
            ]);
        }

        // on parcours les vetements
        foreach($request->vetements as $vetement){
            // on verifie grace a l'id si le vetement se trouve en BD
            $vetementDB = Vetement::find($vetement['id']);

            if($vetement['qte'] != 0){
                if($vetementDB){ // si oui on le modifie ou on supprime
                    if(isset($vetement['action']) && $vetement['action'] === 'delete'){
                        $vetementDB->delete();
                    }else{
                        if( Str::contains($request->commande['type_lavage']['name'],'piece') ){
                            if($vetement['prix_unitaire'] !== 0){
                                $vetementDB->update([
                                    'quantite' => $vetement['qte'],
                                    'prix_unitaire' => $vetement['prix_unitaire'],
                                    'type_vetement_id' => $vetement['type_vetement_id']
                                ]);
                            }
                        }else{
                            $vetementDB->update([
                                'quantite' => $vetement['qte'],
                                'prix_unitaire' => null,
                                'type_vetement_id' => $vetement['type_vetement_id']
                            ]);
                        }
                    }
                }else{ // sinon en l'enregistre
                    if( Str::contains($request->commande['type_lavage']['name'],'piece') ){
                        //  on enregistre le vetement ssi son pu n'est pas 0
                        if($vetement['prix_unitaire'] !== 0){
                            Vetement::create([
                                'type_vetement_id' => $vetement['type_vetement_id'],
                                'commande_id' => $commande->id,
                                'quantite' => $vetement['qte'],
                                'prix_unitaire' => $vetement['prix_unitaire']
                            ]);
                        }
                    }else{
                        Vetement::create([
                            'type_vetement_id' => $vetement['type_vetement_id'],
                            'commande_id' => $commande->id,
                            'quantite' => $vetement['qte'],
                            'prix_unitaire' => null
                        ]);
                    }
                    
                }
            }
            
        }

        return response()->json([
            'commande' => $commande,
            'vetements' => $commande->vetements,
            'message' => 'success'
        ]);
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

    public function printCommande(){
        // 
        $pdf = App::make('dompdf.wrapper');
        
        $commandes = Commande::all();

        $pdf->loadView('pdf.commande-pdf', compact(
            'commandes'
        ));

        return $pdf->stream();
    }

    public function printFacture(Commande $commande,Client $client){

        // send mail
        // Mail::to($client->email)
        //     ->send(new FactureMail($commande));

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.facture', compact(
            'commande'
        ));

        return $pdf->stream();
    }
}
