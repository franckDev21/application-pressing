<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $qte = rand(1,10);
        return [
            'cout_total' => $qte * rand(100,100000),
            'etat' => ['SOLDER','IMPAYER','AVANCER'][rand(0,2)],
            'date_livraison' => now(),
            'description' => $this->faker->paragraph,
            'client_id' => Client::inRandomOrder()->first()->id
        ];
    }
}
