<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsFromView implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cli = Client::all(['id','cnpj','name','fone','email','address']);
        return $cli;
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
