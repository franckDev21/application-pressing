<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Approvisionement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{ 
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ClientSeeder::class,
            TypeLavageSeeder::class,
            CommandeSeeder::class,
            TypeVetementSeeder::class,
            VetementSeeder::class,
            FournisseurSeeder::class,
            ProduitSeeder::class,
            ApprovisionementSeeder::class,
            CaisseSeeder::class,
            CaisseTotalSeeder::class,
            CompteSeeder::class,
        ]);
    }
}
