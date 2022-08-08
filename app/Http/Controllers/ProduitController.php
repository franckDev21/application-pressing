<?php

namespace App\Http\Controllers;

use App\Models\Approvisionement;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::latest()->paginate(6);
        return view('produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        return view('produits.create',compact('fournisseurs'));
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
            'nom' => 'required|string|min:3|max:50',
            'quantite' => 'required|min:0',
            'unite' => 'required',
            'prix_achat' => 'required|min:1',
            'fournisseur_id' => 'required'
        ]);

        Produit::create($data);
        Session::flash('success','Votre produit a été ajouté avec succès !');
        return redirect()->route('produit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        $produits = Produit::all();

        $totalApproEntrer = Approvisionement::where('type','ENTRER')
            ->where('produit_id',$produit->id)
            ->count();

        $totalApproSortie = Approvisionement::where('type','SORTIR')
            ->where('produit_id',$produit->id)
            ->count();  

        return view('produits.show',compact(
            'produits',
            'produit',
            'totalApproEntrer',
            'totalApproSortie'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        $fournisseurs = Fournisseur::all();
        return view('produits.edit',compact('produit','fournisseurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'nom' => 'required|string|min:3|max:50',
            'quantite' => 'required|min:0',
            'unite' => 'required',
            'prix_achat' => 'required|min:1',
            'fournisseur_id' => 'required'
        ]);
        
        $produit->update($data);
        Session::flash('success',"Les informations du produit ($produit->nom) ont été  mise à avec succès !");
        return to_route('produit.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        Session::flash('success',"La suppréssion de ($produit->nom) ont été  éfféctué avec succès !");
        return back();
    }

    public function printProduit(){
        // 
        $pdf = App::make('dompdf.wrapper');
        
        $produits = Produit::all();

        $pdf->loadView('pdf.produit-pdf', compact(
            'produits'
        ));

        return $pdf->stream();
    }
}
