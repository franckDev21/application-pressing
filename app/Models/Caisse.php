<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $fillable = [
        'montant',
        'type',
        'user_id',
        'motif',
        'commande_id'
    ];

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
