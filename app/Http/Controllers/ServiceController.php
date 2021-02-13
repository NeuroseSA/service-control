<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listServices = Service::all();
        $listClients = Client::all();        
        return view('service.serviceIndex', compact('listServices', 'listClients'));
    }

    public function indexAPI()
    {
        $listServices = Service::All();
        return  $listServices->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listClients = Client::all();
        $listService = Service::all();
        
        $os = $listService->where('order')->last();
        if(isset($os)){
            $order_id = $os->order + 1;
        }else{
            $order_id = 1;            
        }       

        return view('service.serviceCreate', compact('listClients', 'order_id'));
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

        return $serv->toJson();
        //return json_encode($serv);

        
        //return $id->id;
        //return redirect(Route('service.index'));
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
        return json_encode($serv);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
