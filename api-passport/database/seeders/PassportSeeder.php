<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class PassportSeeder extends Seeder
{
    public function run()
    {
        $clientRepo = app(ClientRepository::class);

        // Personal Access Client (único necesario para tests)
        $clientRepo->createPersonalAccessClient(
            null,
            'Testing Personal Access Client',
            'http://localhost'
        );
    }
}