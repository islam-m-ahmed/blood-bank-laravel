<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //filter with blood types
        if ($request->select > 0){
            $clients = Client::where('blood_type_id',$request->select)->paginate(20);
        }
        elseif ($request->select == "all")
        {
            $clients = Client::paginate(20);
        }
        else{
            $clients = Client::paginate(20);
        }
        // search with anything
        if ($request->has('search')){
            $clients = Client::where('name','like','%'.$request->search.'%')
                ->orWhere('email','like','%'.$request->search.'%')
                ->orWhere('phone','like','%'.$request->search.'%')
                ->orWhereHas('city',function ($q)use($request){
                    $q->where('name','like','%'.$request->search.'%');
                })->get();
        }
        $blood_types = BloodType::all();
        return view('dashboard.client.index',compact('clients','blood_types'));
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
