<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Info\UserAttr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CrearSuperuser extends Command
{

    protected $signature = 'make:superuser {email} {pass}';
    protected $description = 'Crea un superusuario o actualiza acorde a un email y pass';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $args = $this->arguments();
        $email = $args['email'];
        $pass = $args['pass'];

        $user = User::updateOrCreate(
            [UserAttr::USERNAME => $email],
            [
                UserAttr::USERNAME => $email,
                UserAttr::PASSWORD => Hash::make($pass),
                UserAttr::ES_SUPERUSER => true,
            ]
        );

        $this->info("Se ha actualizado o creado el usuario.");

        return 0;
    }
}
