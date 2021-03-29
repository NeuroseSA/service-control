<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'cnpj' => '61.544.488/0001-02',
            'name' => 'Levi Restaurante ME',
            'fone' => '(11) 2838-4274',
            'email' => 'sistema@levi.com.br',
            'address' => 'Rua Aniceto Ciscato, 619',
        ]);

        DB::table('clients')->insert([
            'cnpj' => '01.076.030/0001-44',
            'name' => 'Vera Joalheria Ltda',
            'fone' => '(11) 3980-4115',
            'email' => 'almoxarifado@joalheria.com.br',
            'address' => 'Rua Sabiá, 619',
        ]);

        DB::table('clients')->insert([
            'cnpj' => '62.288.430/0001-08',
            'name' => 'Filmagens Ltda',
            'fone' => '(11) 2867-5792',
            'email' => 'filmagens@filmagens.com.br',
            'address' => 'Rua Maria Baumann Mendonça, 156',
        ]);

        DB::table('clients')->insert([
            'cnpj' => '69.145.739/0001-98',
            'name' => 'Telecomunicações ME',
            'fone' => '(11) 3529-8595',
            'email' => 'tele@tel.com.br',
            'address' => 'Rua Santa Rosa, 442',
        ]);

        DB::table('clients')->insert([
            'cnpj' => '27.044.664/0001-09',
            'name' => 'Emanuel Propaganda Ltda',
            'fone' => '(16) 2977-3474',
            'email' => 'emanuel@propaganda.com.br',
            'address' => 'Praça Manoel Rodrigues de Farias, 165',
        ]);
    }
}
