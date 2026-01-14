<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Occupation::upsert([
            ['name' => 'อาจารย์'],
            ['name' => 'นักวิจัย นักวิชาการ'],
            ['name' => 'นิสิต นักศึกษา'],
            ['name' => 'ข้าราชการ'],
            ['name' => 'พนักงานเอกชน'],
            ['name' => 'พนักงานรัฐวิสาหกิจ'],
            ['name' => 'พนักงานมหาวิทยาลัย']
        ], uniqueBy: ['name']);
    }
}
