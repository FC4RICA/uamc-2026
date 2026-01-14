<?php

namespace Database\Seeders;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = getenv('ADMIN_EMAIL');
        $pass = getenv('ADMIN_PASSWORD');


        $user = User::firstOrCreate([
            'email' =>  empty($email) ? $email : 'test@example.com',
            'password' => Hash::make(empty($pass) ? $pass : 'testuser123'),
            'is_admin' => true,
        ]);

        Profile::firstOrCreate([
            'user_id' => $user->id,
            'firstname' => 'Test',
            'lastname' => 'User',
            'phone' => '0123456789',
            'title' => Title::MR,
            'academic_title' => AcademicTitle::NONE,
            'education' => Education::BACHELOR,
            'participation_type' => ParticipationType::PRESENTER,
            'presentation_type' => PresentationType::ORAL,
            'occupation_id' => 1,
            'organization_id' => 1,
        ]);
    }
}
