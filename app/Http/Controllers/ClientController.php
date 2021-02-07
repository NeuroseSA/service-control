<?php

namespace App\Http\Controllers;

use App\Models\Client;


use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listClient = Client::all();
        return view("client.clientIndex", compact("listClient"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("client.clientCreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|unique:Clients',
            'name' => 'required|min:4',
            'fone' => 'required',
            'address' => 'required|min:4',
            'email' => 'required'
        ], [
            'cnpj.required' => 'O CNJP deve ser obrigatório',
            'cnpj.unique' => 'CNJP já cadastrado',
            'name.required' => 'Nome do cliente é obrigatório',
            'fone.required' => 'Idade do cliente é obrigatório',
            'address.required' => 'Endereço do cliente é obrigatório',
            'email.required' => 'E-mail do cliente é obrigatório',
        ]);

        try {
            $cli = new Client();
            $cli->cnpj = $request->input("cnpj");
            $cli->name = $request->input("name");
            $cli->fone = $request->input("fone");
            $cli->email = $request->input("email");
            $cli->address = $request->input("address");
            $cli->save();
            return redirect(route('client.index'));
        } catch (\Throwable $th) {
            return redirect(route('client.new'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cli = Client::find($id);
        return view('client.clientEdit', compact("cli"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cli = Client::find($id);
        if ($cli->email == $request->email) {
        $request->validate([
            'cnpj' => 'required',
            'name' => 'required|min:4',
            'fone' => 'required',
            'address' => 'required|min:4',
            'email' => 'required'
        ], [
            'cnpj.required' => 'O CNJP deve ser obrigatório',
            'name.required' => 'Nome do cliente é obrigatório',
            'fone.required' => 'Idade do cliente é obrigatório',
            'address.required' => 'Endereço do cliente é obrigatório',
            'email.required' => 'E-mail do cliente é obrigatório',
        ]);
        }else{
            $request->validate([
                'cnpj' => 'required|unique:Clients',
                'name' => 'required|min:4',
                'fone' => 'required',
                'address' => 'required|min:4',
                'email' => 'required'
            ], [
                'cnpj.required' => 'O CNJP deve ser obrigatório',
                'cnpj.unique' => 'CNJP já cadastrado',
                'name.required' => 'Nome do cliente é obrigatório',
                'fone.required' => 'Idade do cliente é obrigatório',
                'address.required' => 'Endereço do cliente é obrigatório',
                'email.required' => 'E-mail do cliente é obrigatório',
            ]);
        }

        try {           

            $cli->cnpj = $request->input("cnpj");
            $cli->name = $request->input("name");
            $cli->fone = $request->input("fone");
            $cli->email = $request->input("email");
            $cli->address = $request->input("address");
            $cli->save();
            return redirect(route('client.index'));
        } catch (\Throwable $th) {
            return redirect(route('client.edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Client::find($id);
        if (isset($cli)) {
            $cli->delete();
        }
        return redirect(route('client.index'));
    }
}
