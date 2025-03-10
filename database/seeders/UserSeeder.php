<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'alberto@jesus.com.br')->first()){
            User::create([
                'name' => 'Alberto',
                'email' => 'alberto@jesus.com.br',
                'password' => Hash::make('12345678'),
            ]);
        }
        if(!User::where('email', 'andreamello@jesus.com.br')->first()){
            User::create([
                'name' => 'Andrea Mello',
                'email' => 'andreamello@jesus.com.br',
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
