<?php

namespace App\Http\Controllers;

use App\Models\CaisseTotal;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\TypeVetement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalCommande = Commande::all()->count();
        $totalClient = Client::all()->count();
        $totalFournisseur = Fournisseur::all()->count();
        $totalProduit = Produit::all()->count();
        $totalTypeVetement = TypeVetement::all()->count();
        $totalMontantCaisse = (CaisseTotal::all())->sum('montant');


        return view('index',compact(
            'totalCommande',
            'totalClient',
            'totalFournisseur',
            'totalProduit',
            'totalMontantCaisse',
            'totalTypeVetement'
        ));
    }
}
