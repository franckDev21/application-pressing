<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'quantite',
        'unite',
        'prix_achat',
        'fournisseur_id'
    ];

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }

    public function approvisionnements(){
        return $this->hasMany(Approvisionement::class) ;
    }
}
