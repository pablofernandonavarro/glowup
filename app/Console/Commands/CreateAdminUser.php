<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo usuario administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Crear nuevo usuario administrador');
        $this->newLine();

        $name = $this->ask('Nombre del usuario');
        $email = $this->ask('Email');

        // Verificar si el email ya existe
        if (User::where('email', $email)->exists()) {
            $this->error('Ya existe un usuario con ese email.');
            return 1;
        }

        $password = $this->secret('Contraseña (mínimo 8 caracteres)');

        if (strlen($password) < 8) {
            $this->error('La contraseña debe tener al menos 8 caracteres.');
            return 1;
        }

        $passwordConfirmation = $this->secret('Confirmar contraseña');

        if ($password !== $passwordConfirmation) {
            $this->error('Las contraseñas no coinciden.');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->newLine();
        $this->info("✓ Usuario administrador creado exitosamente!");
        $this->table(
            ['Campo', 'Valor'],
            [
                ['Nombre', $user->name],
                ['Email', $user->email],
                ['Rol', $user->role],
            ]
        );

        return 0;
    }
}
