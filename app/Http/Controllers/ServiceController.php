<?php

namespace App\Http\Controllers;

use App\Exports\ServicesFromView;
use Maatwebsite\Excel\Facades\Excel;
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
        $title = array(
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

        $filter_id = null;
        $filter_category = null;
        $filter_client_id = null;
        $filter_order = 22;
        return Excel::download(new ServicesFromView($title, $filter_id,  $filter_category,  $filter_client_id, $filter_order, $title), 'Services.xlsx');
    }
}
