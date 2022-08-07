<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionement extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'prix_achat',
        'date',
        'produit_id'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
