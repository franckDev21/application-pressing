<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'cout_total',
        'etat',
        'description',
        'date_livraison',
        'client_id',
        'type_lavage_id',
        'poids',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_livraison' => 'datetime',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function typeLavage(){
        return $this->belongsTo(TypeLavage::class);
    }

    public function vetements(){
        return $this->hasMany(Vetement::class);
    }
}
