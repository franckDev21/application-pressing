<?php

namespace App\Http\Controllers;

use App\Models\Approvisionement;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApprovisionementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvisionnements = Approvisionement::latest()->paginate(6);
        $produits = Produit::all();
        return view('approvisionnements.index',compact('approvisionnements','produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'quantite' => 'required',
            'prix_achat' => 'required',
            'date' => 'required',
            'produit_id' => 'required'
        ]);

        // on cree l'appro
        Approvisionement::create($data);

        //  on met a jour la quantité en stock du produit conserner
        $produit = Produit::findOrFail($request->produit_id);
        $produit->update([
            'quantite' => ((int)$request->quantite + (int)$produit->quantite)
        ]);

        Session::flash('success','Approvisionnement créé avec succès !');
        return to_route('appro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approvisionement  $approvisionement
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionement $approvisionement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvisionement  $approvisionement
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvisionement $approvisionement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approvisionement  $approvisionement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionement $approvisionement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvisionement  $approvisionement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionement $approvisionement)
    {
        $approvisionement->delete();
        Session::flash('success',"La suppréssion de l'approvisionnement a été  éfféctué avec succès !");
        return back();
    }
}
