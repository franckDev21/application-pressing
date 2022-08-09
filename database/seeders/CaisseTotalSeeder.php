<?php

namespace Database\Seeders;

use App\Models\CaisseTotal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaisseTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CaisseTotal::factory(1)->create();
    }
}
