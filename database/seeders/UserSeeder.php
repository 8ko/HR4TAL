<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $admin = new User;
        $admin->employee_id = 0;
        $admin->first_name = Str::random(5);
        $admin->last_name = Str::random(5);
        $admin->email = 'admin@roc.ph';
        $admin->password = Hash::make('12345678');
        $admin->save();
        $admin->attachRole('admin');

        // engr
        $engr = new User;
        $engr->employee_id = 1;
        $engr->first_name = Str::random(5);
        $engr->last_name = Str::random(5);
        $engr->email = 'engr@roc.ph';
        $engr->password = Hash::make('12345678');
        $engr->save();
        $engr->attachRole('engr');

        //hr
        $hr = new User;
        $hr->employee_id = 2;
        $hr->first_name = Str::random(5);
        $hr->last_name = Str::random(5);
        $hr->email = 'hr@roc.ph';
        $hr->password = Hash::make('12345678');
        $hr->save();
        $hr->attachRole('hr');

        //user
        $user = new User;
        $user->employee_id = 3;
        $user->first_name = Str::random(5);
        $user->last_name = Str::random(5);
        $user->email = 'user@roc.ph';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->attachRole('user');
    }
}
