<?php

namespace App\Exports;

use App\Http\Controllers\ClientController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find(Auth::user()->id);
        if ($user->isAdmin) {
            $listClient = Client::all();
        }else{
            $listClient = $user->clients()->get();
        }

        return $listClient;
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
