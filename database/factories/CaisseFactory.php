<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Caisse>
 */
class CaisseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'montant' => rand(1,500000),
            'type' => ['ENTRER','SORTIR'][rand(0,1)],
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
