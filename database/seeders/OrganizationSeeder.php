<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::upsert([
            ['name' => 'มหาวิทยาลัยศิลปากร'],
            ['name' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง'],
            ['name' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี'],
            ['name' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ'],
            ['name' => 'มหาวิทยาลัยเทคโนโลยีสุรนารี'],
        ], uniqueBy: ['name']);
    }
}
