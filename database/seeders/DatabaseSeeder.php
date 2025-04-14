<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trabajador;
use App\Models\Blog;
use App\Models\Producto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 5 trabajadores
        $trabajadores = Trabajador::factory(5)->create();

        // Crear 10 blogs asociados a trabajadores aleatorios
        Blog::factory(10)
            ->recycle($trabajadores)
            ->create();

        // Crear 20 productos
        Producto::factory(20)->create();

        // Crear un trabajador administrador con credenciales conocidas
        Trabajador::factory()->create([
            'usuario' => 'admin',
            'password' => bcrypt('admin123'),
            'nombre_completo' => 'Administrador',
            'apellidos' => 'Sistema',
            'dni' => '12345678',
        ]);
    }
}