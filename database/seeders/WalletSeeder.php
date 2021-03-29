<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 6; $i++) {
            DB::table('wallet')->insert([
                'user_id' => $i,
                'client_id' => $i,
            ]);
        }
    }
}
