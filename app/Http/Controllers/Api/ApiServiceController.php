<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Service::paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serv = new Service();  
        $cli = Client::where('name', $request->input('client'))->first();;    
        $serv->category = $request->input('category');
        $serv->price = $request->input('price');
        $serv->amount = $request->input('amount');
        $serv->order = $request->input('order');
        $serv->model = $request->input('model');
        $serv->windows_key = $request->input('windows_key');
        $serv->description = $request->input('description');
        $serv->client_id = $cli->id;
        $serv->save();

        return json_encode($serv);        
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
        $serv = Service::find($id);
        //$os = Service::where('order' , $id);
        $os = Service::where('order' , $serv->order)->get();
       // return $os::paginate(1);
       return $os;
       // return json_encode($os);
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
        $serv = Service::find($id);
        $cli = Client::where('id', $request->input('client_id'))->first();;    
        $serv->status = $request->input('status');
        $serv->category = $request->input('category');
        $serv->price = $request->input('price');
        $serv->amount = $request->input('amount');
        $serv->order = $request->input('order');
        $serv->model = $request->input('model');
        $serv->windows_key = $request->input('windows_key');
        $serv->description = $request->input('description');
        $serv->client_id = $cli->id;
        $serv->save();

        return json_encode($serv);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serv = Service::find($id);
        if(isset($serv)){
            $serv->delete();
        }
    }

    public function destroyOrder($order)
    {
        $serv = Service::where('order' , $order);

        if(isset($serv)){
            $serv->delete();
        }
    }
    
}
