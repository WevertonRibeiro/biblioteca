<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Usuario Padrao',
            'email' => 'email@email.com.br',
            'password' => bcrypt('senhapadrao'),
            'tipo' => 's',
            'endereco' => 'endereco padrao',
            'telefone' => '98888-9999',
            'cpf' => '99988877766'
        ]);
    }
}
