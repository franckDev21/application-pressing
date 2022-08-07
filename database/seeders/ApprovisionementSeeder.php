<?php

namespace Database\Seeders;

use App\Models\Approvisionement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovisionementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Approvisionement::factory(50)->create();
    }
}
