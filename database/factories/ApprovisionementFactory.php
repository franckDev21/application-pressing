<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approvisionement>
 */
class ApprovisionementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantite' => rand(1,50),
            'prix_achat' => rand(100,500000),
            'date' => now(),
            'type' => ['ENTRER','SORTIR','UPDATE'][rand(0,2)],
            'produit_id' => Produit::inRandomOrder()->first()->id
        ];
    }
}
