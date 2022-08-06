<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::latest()->paginate(6);
        return view('fournisseurs.index',compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseurs.create');
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
            'address' => 'required|string|min:3|max:50',
            'email' => 'email|unique:clients|unique:fournisseurs',
            'tel' => 'required|min:3|max:50'
        ]);


        Fournisseur::create($data);
        Session::flash('success','Votre fournisseur a été ajouté avec succès !');
        return redirect()->route('fournisseur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit',compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $data = $request->validate([
            'nom' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:3|max:50',
            'email' => 'email',
            'tel' => 'required|min:3|max:50'
        ]);
        
        $fournisseur->update($data);
        Session::flash('success',"Les informations du fournisseur ($fournisseur->nom) ont été  mise à avec succès !");
        return to_route('fournisseur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        Session::flash('success',"La suppréssion de ($fournisseur->nom) ont été  éfféctué avec succès !");
        return back();
    }


    public function printFournisseur(){
        // 
        $pdf = App::make('dompdf.wrapper');
        
        $fournisseurs = Fournisseur::all();

        $pdf->loadView('pdf.fournisseur-pdf', compact(
            'fournisseurs'
        ));

        return $pdf->stream();
    }

}
