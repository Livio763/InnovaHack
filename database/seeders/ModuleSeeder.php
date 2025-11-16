<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // No usar TRUNCATE porque MySQL lo prohíbe si existen FKs
        Module::query()->delete();

        Module::create([
            'name' => 'Ideación y Validación',
            'description' => 'Descubre y valida tu idea de negocio',
            'order' => 1,
            'icon' => 'lightbulb',
            'max_days' => 7,
            'is_active' => true,
        ]);
        Module::create([
            'name' => 'Propuesta de Valor',
            'description' => 'Construye una propuesta irresistible',
            'order' => 2,
            'icon' => 'value',
            'max_days' => 7,
            'is_active' => true,
        ]);
        Module::create([
            'name' => 'Marketing Digital',
            'description' => 'Aprende a promocionar tu negocio',
            'order' => 3,
            'icon' => 'marketing',
            'max_days' => 7,
            'is_active' => true,
        ]);
    }
}
