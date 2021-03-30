<?php

namespace App\Http\Controllers;

use App\Exports\ServicesFromView;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Service;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user = User::find(Auth::user()->id);

        if ($user->isAdmin) {
            $listServices = Service::all();
        }else{
            $listClient = $user->clients()->select('client_id')->get();       
            $cli = [];
            for ($i=0; $i < $listClient->count(); $i++) { 
                $cli[$i] = $listClient[$i]->client_id;
            }
            $listServices = Service::whereIn('client_id', $cli )->get();
        }
        $listClients = Client::all();
        return view('service.serviceIndex', compact('listServices', 'listClients'));
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
        if (isset($os)) {
            $order_id = $os->order + 1;
        } else {
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
        //
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
        //
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

    public function export(Request $request){ 
    
        $columns = array(
            'id' => $request->input('f_id'),
            'client_id' => $request->input('f_client_id'),
            'category' => $request->input('f_category'),
            'description' => $request->input('f_description'),
            'model' => $request->input('f_model'),
            'windows_key' => $request->input('f_windows_key'),
            'price' => $request->input('f_price'),
            'amount' => $request->input('f_amount'),
            'order' => $request->input('f_order')
        );

        $client_id = Client::where('name', $request->input('filter_client_id'))->first();        

        $filters = array(
            'filter_client_id' => $client_id ? $client_id->id : null,
            'filter_category' => $request->input('filter_category'),
            'filter_order' => $request->input('filter_order')
        );

        return Excel::download(new ServicesFromView($columns, $filters), 'Services.xlsx');
    }

    public function listFilter(Request $request){

        $this->order = $request->input('order');
        $this->client = $request->input('client');
        $this->category = $request->input('category');            
 
        return Service::where(function ($query) {
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
         })->orderBy('id', 'ASC')->paginate(5);
    }

}
