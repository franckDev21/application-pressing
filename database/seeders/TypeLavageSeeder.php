<?php

namespace Database\Seeders;

use App\Models\TypeLavage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeLavageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeLavage::factory(20)->create();
    }
}
