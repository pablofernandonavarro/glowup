<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:make-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convertir un usuario en administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("No se encontró un usuario con el email: {$email}");
            return 1;
        }

        $user->update(['role' => 'admin']);

        $this->info("El usuario {$user->name} ({$email}) ahora es administrador.");
        return 0;
    }
}
