<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@glowup.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Usuario de prueba normal
        User::create([
            'name' => 'Usuario Test',
            'email' => 'user@glowup.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'email_verified_at' => now(),
            // Datos de perfil de ejemplo
            'peso_inicial' => 85.5,
            'peso_objetivo' => 75.0,
            'altura' => 175.0,
            'cintura' => 90.0,
            'cadera' => 100.0,
            'pecho' => 95.0,
            'brazo' => 35.0,
            'pierna' => 60.0,
        ]);

        $this->command->info('✓ Usuarios de prueba creados:');
        $this->command->table(
            ['Rol', 'Email', 'Contraseña'],
            [
                ['Admin', 'admin@glowup.com', 'admin123'],
                ['Usuario', 'user@glowup.com', 'user123'],
            ]
        );
    }
}
