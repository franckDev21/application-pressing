<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetement extends Model
{
    use HasFactory;

    protected $fillable  = [
        'statut',
        'type_vetement_id',
        'commande_id',
        'service_demander'
    ];

    public function typeVetement(){
        return $this->belongsTo(TypeVetement::class);
    }
}
