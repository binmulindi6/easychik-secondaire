<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $employer = Employer::find(1);

        User::create([
            'email' => 'admin@easychik.com',
            'password' => Hash::make('admin@easyChik'),
            'employer_id' => 1,
            'isActive' => 1,
            'isAdmin' => 1,
        ]);
    }
}
