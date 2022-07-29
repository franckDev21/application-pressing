<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\TypeVetement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vetement>
 */
class VetementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_vetement_id' => TypeVetement::inRandomOrder()->first()->id,
            'commande_id' => Commande::inRandomOrder()->first()->id,
            // 'service_demander' => ['LAVAGE','LAVAGE_REPASSAGE'][rand(0,1)],
            'statut' => [
                'REÇU',
                'EN_COURS_DE_LAVAGE',
                'LAVÉ',
                'EN_COURS_DE_REPASSAGE',
                'REPASSÉ',
                'TERMINÉ'
            ][rand(0,5)]
        ];
    }
}
