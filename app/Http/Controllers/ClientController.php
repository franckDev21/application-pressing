<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(6);
        return view('clients.index',compact('clients'));
    }

    public function indexApi()
    {
        if(!auth()->user()) abort(403);
        
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'prenom' => 'required|string|min:3|max:50',
            'email' => 'email|unique:clients',
            'tel' => 'required|min:3|max:50'
        ]);

        Client::create($data);
        Session::flash('success','Votre client a été ajouté avec succès !');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'nom' => 'required|string|min:3|max:50',
            'prenom' => 'required|string|min:3|max:50',
            'email' => 'email',
            'tel' => 'required|min:3|max:50'
        ]);
        
        $client->update($data);
        Session::flash('success',"Les informations du client ($client->nom $client->prenom) ont été  mise à avec succès !");
        return to_route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Session::flash('success',"La suppréssion de ($client->nom $client->prenom) ont été  éfféctué avec succès !");
        $client->delete();
        return to_route('client.index');
    }
}
