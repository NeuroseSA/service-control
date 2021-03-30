<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cli = 1;
        for ($i=1; $i <= 25; $i++) { 
           
        DB::table('services')->insert([
            'client_id' => $cli,    
            'category' => 'Concerto',
            'status' => 'Em andamento',
            'price' => 150.00,
            'amount' => 3,
            'order' => $i,
            'model' => 'Acer',
            'windows_key' => 'Não possui',
            'description' => 'Tela acendendo e apagando',
        ]);

        DB::table('services')->insert([
            'client_id' => $cli,    
            'category' => 'Formatação',
            'status' => 'Finalizado',
            'price' => 50.00,
            'amount' => 2,
            'order' => $i,
            'model' => 'Lenovo',
            'windows_key' => 'DSASADD-DASDASD-SADASD',
            'description' => 'PC travando muito',
        ]);

        DB::table('services')->insert([
            'client_id' => $cli,    
            'category' => 'Formatação e Manutenção Preventiva',
            'status' => 'Reprovado',
            'price' => 250.00,
            'amount' => 1,
            'order' => $i,
            'model' => 'Lenovo',
            'windows_key' => 'DSASADD-DASDASD-SADASD',
            'description' => 'Tela quebrada e travando',
        ]);

        $cli++;
        if ($cli > 5) {
            $cli = 1;
        }
    }
}
}
