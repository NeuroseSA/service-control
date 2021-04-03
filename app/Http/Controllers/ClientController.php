<?php

namespace App\Http\Controllers;

use App\Exports\ClientsFromView;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new ClientsFromView, 'clientes.xlsx');
    }

    public function filter()
    {

        return  Client::all();
    }

    public function index()
    {
        $user = User::find(Auth::user()->id);
        if ($user->isAdmin) {
            $listClient = Client::paginate(5);
        } else {
            $listClient = $user->clients()->paginate(5);
        }

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
    public function store(ClientRequest $request)
    {
        $cnpjValidate = User::where('cnpj', $request->input("cnpj"))->first();
        if ($cnpjValidate) {
            return redirect()->back()->withErrors('CNPF ja cadastrado!');
        }
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
    public function update(ClientRequest $request, $id)
    {
        $cnpjValidate = Client::where('cnpj', $request->input("cnpj"))->first();
        if ($cnpjValidate->id != $id) {
            return redirect()->back()->withErrors('CNPJ ja cadastrado!');
        }

        $cli = Client::find($id);
        $cli->cnpj = $request->input("cnpj");
        $cli->name = $request->input("name");
        $cli->fone = $request->input("fone");
        $cli->email = $request->input("email");
        $cli->address = $request->input("address");
        $cli->save();
        return redirect(route('client.index'));
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

    public function getName($getName)
    {
        $cli = Client::where('id', $getName)->first();
        return $cli;
    }
}
