<?php

namespace App\Exports;

use App\Http\Controllers\ClientController;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsFromView implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $col = 'id';
        $col2 = null;
       // $cli = Client::all([$col]);
        //$cli = DB::table('clients')->where('id', '1')->first();
        $cli = new ClientController();
        $exp = $cli->filter();
       // dd($exp);
        return $exp::all([$col])->where('id', 1);
    }

    public function headings(): array
    {
        return [
            'ID',
            'CNPJ',
            'Razão Social',
            'Contato',
            'Email',
            'Endereço Completo',
        ];
    }

}
