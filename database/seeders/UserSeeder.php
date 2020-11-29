<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    const NUMBER_OF_USERS = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count()) {
            echo "Skipping User; data already exists\n";
            return;
        }

        User::factory()->count(self::NUMBER_OF_USERS)->create();

        // pre-configured user data for manual testing purposes
        $volunteer = new User();
        $volunteer->name = 'Volunteer User';
        $volunteer->email = 'volunteer@test.com';
        $volunteer->password = Hash::make('password');
        $volunteer->admin = 0;
        $volunteer->save();

        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@test.com';
        $admin->password = Hash::make('password');
        $admin->admin = 1;
        $admin->save();
    }
}
