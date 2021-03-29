<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
       
        DB::table('users')->insert([
            'name' => 'João Paulo',
            'cpf' => '052.360.751-00',
            'fone' => '(67) 998370-7546',
            'email' => 'joaopaulo@gmail.com',
            'password' => '102030',
            'isAdmin' => false,
        ]);

        DB::table('users')->insert([
            'name' => 'Alex Junior',
            'cpf' => '052.304.985-00',
            'fone' => '(67) 998545-7546',
            'email' => 'alex@gmail.com',
            'password' => '102030',
            'isAdmin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'Graziela Gomes',
            'cpf' => '001.564.721-55',
            'fone' => '(67) 998570-7546',
            'email' => 'grazi@gmail.com',
            'password' => '102030',
            'isAdmin' => false,
        ]);

        DB::table('users')->insert([
            'name' => 'Marcos Melo',
            'cpf' => '789.546.258-00',
            'fone' => '(67) 998570-7546',
            'email' => 'marcosmelo@gmail.com',
            'password' => '102030',
            'isAdmin' => false,
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Santos',
            'cpf' => '465.258.435-66',
            'fone' => '(67) 998570-7546',
            'email' => 'maria@gmail.com',
            'password' => '102030',
            'isAdmin' => false,
        ]);
    
    }
}
