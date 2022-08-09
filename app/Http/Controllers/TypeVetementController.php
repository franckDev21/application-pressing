<?php

namespace App\Http\Controllers;

use App\Models\TypeVetement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeVetementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeVetements = DB::table('type_vetements')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->paginate(6);
        
        return view('typeVetement.index',compact('typeVetements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeVetement  $typeVetement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeVetement $typeVetement)
    {
        $data = $request->validate([
            'name' => 'required|min:3'
        ]);

        $typeVetement->update($data);

        return back();
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|min:3'
        ]);

        TypeVetement::create($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeVetement  $typeVetement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeVetement $typeVetement)
    {
        $typeVetement->delete();
        return back();
    }
}
