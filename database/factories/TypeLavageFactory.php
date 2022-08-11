<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeLavage>
 */
class TypeLavageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ['lavage par piece','lavage par kg','lavage watch and go'][rand(0,2)],
            'prix_par_kg' => [1500,750][rand(0,1)],
        ];
    }
}
