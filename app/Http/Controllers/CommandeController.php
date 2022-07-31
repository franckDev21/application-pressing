<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\TypeVetement;
use App\Models\Vetement;
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

    public function vetements(Request $request,Commande $commande){
        $typeVetements = TypeVetement::all();
        return view('commandes.vetements',compact('commande','typeVetements'));
    }

    public function vetementStore(Request $request){
        $data = $request->validate([
            "vetement_id"       => "required",
            "type_vetement_id"  => "required",
            "statut"            => "required",
            "service_demander"  => "required"
        ]);

        $vetement = Vetement::findOrFail($request->vetement_id);
        $vetement->update($data);

        Session::flash('success',"La mise du vêtement à été éfféctuer avec succès !");
        return back();
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
            Vetement::create([
                'type_vetement_id' => $vetement['type_vetement_id'],
                'commande_id' => $commande->id
            ]);
        }

        return response()->json('success');
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
        //
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
        //
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
