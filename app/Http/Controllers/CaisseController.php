<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\CaisseTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CaisseController extends Controller
{
    public function index(){
        $caisses = Caisse::latest()->paginate(6);
        $caissesTotal = CaisseTotal::all();
        $total = $caissesTotal->sum('montant');
        return view('caisse.index',compact('caisses','total'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'montant' => 'required',
            'motif' => 'required',
        ]);
        
        Caisse::create(array_merge([
            'user_id' => auth()->user()->id,
            'type' => 'ENTRER'
        ],$data));

        $caisse = CaisseTotal::first();
        $total = $caisse->sum('montant');

        $caisse->update([
            'montant' => (int)$total + (int)$request->montant
        ]);
        

        Session::flash('success',"Nouvelle entrée enregister !");
        return back();
    }

    public function sortie(Request $request){
        
        $data = $request->validate([
            'montant' => 'required',
            'motif' => 'required',
        ]);

        $caisses = CaisseTotal::all();
        $total = $caisses->sum('montant');


        if((int)$request->montant <= $total){

            $caisse = CaisseTotal::first();

            $caisse->update([
                'montant' => (int)$total - (int)$request->montant
            ]);
            
            Caisse::create(array_merge([
                'user_id' => auth()->user()->id,
                'type' => 'SORTIR'
            ],$data));
    
            Session::flash('success',"Nouvelle entrée enregister !");
            return back();
        }else{
            Session::flash('success',"Erreur ...");
            return back();
        }
        
    }

    public function printCaisse(){
        
        $pdf = App::make('dompdf.wrapper');
        
        $caisses = Caisse::latest()->get();
        $caissesTotal = CaisseTotal::all();
        $total = $caissesTotal->sum('montant');

        $pdf->loadView('pdf.caisse-pdf', compact(
            'caisses',
            'total'
        ));

        return $pdf->stream();
    }
    
}
