<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        //
        $clients = Client::all();
        return view('dashboard.client.index',compact('clients'));
    }


    //status
    public function status($id,$status){
        $client = Client::findOrFail($id);
        $client->update(['status'=>$status]);
        return back()->withStatus('status change successfully');

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
        $client = Client::findOrFail($id);
        return view('dashboard.client.view',compact('client'));
    }


    public function destroy($id)
    {
        //
        $client = Client::findOrFail($id);
        $client->delete();
        return back()->withStatus('client deleted successfully');
    }
}
