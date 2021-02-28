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
        $serv = Service::find($id);
        $cli = Client::where('id', $request->input('client_id'))->first();;    
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

   
    public function listFilter(Request $request){

        $this->order = $request->input('order');
        $this->client = $request->input('client');
        $this->category = $request->input('category');            


        $list = Service::where(function ($query) {
            if ($this->order != null & $this->order > 0) {
                $query->where('order', $this->order);
            }
            if ($this->client != "Selecione") {
                $this->client_id = Client::where('name', $this->client)->first();
                $query->where('client_id', $this->client_id->id);
            }
            if ($this->category != "Selecione") {
                $query->where('category', $this->category);
            }
        })->orderBy('id', 'ASC')->get();
        
        return json_encode($list);
    }

}
