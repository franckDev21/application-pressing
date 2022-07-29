<?php

namespace Database\Factories;

use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'quantite' => rand(1,50),
            'unite'  => ['L','KG','G'][rand(0,2)],
            'fournisseur_id' => Fournisseur::inRandomOrder()->first()->id
        ];
    }
}
