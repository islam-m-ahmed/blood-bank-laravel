<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //filter
        if ($request->select > 0){
            $donation_requests = DonationRequest::where('blood_type_id',$request->select)->paginate(20);
        }
        elseif ($request->select == "all")
        {
            $donation_requests = DonationRequest::paginate(20);
        }
        else{
            $donation_requests = DonationRequest::paginate(20);
        }
        //$donation_requests
        // search with anything
        if ($request->has('search')){
            $donation_requests = DonationRequest::where('patient_name','like','%'.$request->search.'%')
                ->orWhere('patient_phone','like','%'.$request->search.'%')
                ->orWhere('patient_age','like','%'.$request->search.'%')
                ->orWhere('bags_num','like','%'.$request->search.'%')
                ->orWhereHas('city',function ($q)use($request){
                    $q->where('name','like','%'.$request->search.'%');
                })->get();
            //when in do user to know who is
//                ->orWhereHas('user',function ($q) use($request){
//                    $q->where('name','like','%'.$request->search.'%');
//                })
        }
       $blood_types = BloodType::all();
        return view('dashboard.donation_request.index',compact('donation_requests','blood_types'));

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
        $donation = DonationRequest::findOrFail($id);
        $donation->delete();
        return back()->withStatus('donation Request deleted successfully');
    }
}
