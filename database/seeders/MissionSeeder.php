<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Evitar TRUNCATE por FKs; borrar en orden seguro
        DB::table('badges')->delete();
        DB::table('user_progress')->delete();
        DB::table('mission_submissions')->delete();
        Mission::query()->delete();

        $module1 = Module::where('order', 1)->first();
        if ($module1) {
            Mission::create([
                'module_id' => $module1->id,
                'title' => 'Curso de bienvenida',
                'description' => 'Conoce GIA, los pilares del programa (finanzas, modelo de negocio y hábitos emprendedores) y cómo aprovechar cada misión.',
                'order' => 1,
                'points' => 100,
                'video_url' => null,
                'badge_icon' => '🎓',
                'badge_name' => 'Bienvenida GIA',
                'submission_type' => 'text',
                'is_active' => true,
            ]);
            Mission::create([
                'module_id' => $module1->id,
                'title' => 'Valida con tu mercado',
                'description' => 'Habla con 5 potenciales clientes y registra aprendizajes',
                'order' => 2,
                'points' => 150,
                'video_url' => null,
                'submission_type' => 'text',
                'is_active' => true,
            ]);
        }
    }
}
