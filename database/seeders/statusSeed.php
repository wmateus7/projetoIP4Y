<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class statusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Condição if: Caso possua registro 'Pendente' não duplique
           if (!Status::where('description', 'Pendente')->first()) {
            Status::create([
                'description' => "Pendente"
            ]);
        }
        if (!Status::where('description', 'Em Progresso')->first()) {
            Status::create([
                'description' => "Em Progresso"
            ]);
        }
        if (!Status::where('description', 'Concluído')->first()) {
            Status::create([
                'description' => "Concluído"
            ]);
        }
    }
}
