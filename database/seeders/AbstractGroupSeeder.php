<?php

namespace Database\Seeders;

use App\Models\AbstractGroup;
use Illuminate\Database\Seeder;

class AbstractGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AbstractGroup::upsert([
            ['id' => 1, 'name' => 'Pure Mathematics'],
            ['id' => 2, 'name' => 'Data Science / AI / Statistics'],
            ['id' => 3, 'name' => 'Differential Equations / Numerical Analysis'],
            ['id' => 4, 'name' => 'Mathematical Modelling / Simulations'],
            ['id' => 5, 'name' => 'Mathematics for Industry / Finance / Insurance'],
        ], uniqueBy: ['name']);
    }
}
