<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  cria categorias padrao p Vitrine
        Category::create(['name' => 'Tecnologia']);
        Category::create(['name' => 'Música']);
        Category::create(['name' => 'Negócios']);
        Category::create(['name' => 'Esportes']);

        //  cria conta padrao organizador
        User::create([
            'name' => 'Carlos Organizador',
            'email' => 'organizador@teste.com',
            'password' => Hash::make('senha123'),
            'role' => 'organizador',
        ]);

        // cria conta padrao participante
        User::create([
            'name' => 'Lucas Participante',
            'email' => 'participante@teste.com',
            'password' => Hash::make('senha123'),
            'role' => 'participante',
        ]);
    }
}