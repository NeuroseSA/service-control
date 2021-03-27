<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listUser = User::paginate(5);
        return view('user.userIndex', compact('listUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('user.userCreate', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $u = new User();
        $u->cpf = $request->input("cpf");
        $u->name = $request->input("name");
        $u->password = $request->input("password");
        $u->fone = $request->input("fone");
        $u->email = $request->input("email");
        $u->isAdmin = $request->input('isAdmin');
        if(isset($u->isAdmin)){
            $u->isAdmin = true;
        }
        $u->save();

        $iduser = User::where('email', $request->input("email"))->first();

        foreach ($request->clientsUser as $item) {
            $wallet = new Wallet();
            $wallet->user_id = $iduser->id;
            $wallet->client_id = $item;
            $wallet->save();
        }

        return redirect(route('user.index'));
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
        $user = User::find($id);
        $clients = Client::all();
        $user = User::find($id);
        $listClient = $user->clients()->get();
        return view('user.userEdit', compact('user', 'clients', 'listClient'));
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
        $u = User::find($id);
        $u->cpf = $request->input("cpf");
        $u->name = $request->input("name");
        $u->password = $request->input("password");
        $u->fone = $request->input("fone");
        $u->email = $request->input("email");
        $u->isAdmin = $request->input('isAdmin');
        if(isset($u->isAdmin)){
            $u->isAdmin = true;
        }
        $u->save();

        $walletdrop = Wallet::where('user_id', $id)->get();
        if (isset($walletdrop)) {
            foreach ($walletdrop as $item) {
                $user = Wallet::find($item->id);
               
                if (isset($user)) {
                    $user->delete();
                }
            }
        }

        $iduser = User::where('email', $request->input("email"))->first();

        foreach ($request->clientsUser as $item) {
            $wallet = new Wallet();
            $wallet->client_id = $item;
            $wallet->user_id = $iduser->id;
            $wallet->save();
        }

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (isset($user)) {
            $user->delete();
        }
        return redirect(route('user.index'));
    }
}
