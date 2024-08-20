<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Condição if: Caso possua registro 'Pendente' não duplique
         if (!User::where('email', 'admin@projects.com')->first()) {
            User::create([
                'Name' => "Admin",
                "Email"=>'admin@projects.com',
                'Type'=>'adm',
                "password"=>Hash::make('12345678', ['rounds' =>12])
            ]);
        }
        if (!User::where('email', 'user@projects.com')->first()) {
            User::create([
                'Name' => "User",
                "Email"=>'user@projects.com',
                'Type'=>'user',
                "password"=>Hash::make('12345678', ['rounds' =>12])
            ]);
        }
    }
}
