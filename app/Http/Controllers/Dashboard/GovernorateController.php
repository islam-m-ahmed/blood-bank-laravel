<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GovernorateRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $governorates = Governorate::paginate(20);
        return view('dashboard.governorate.index',compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.governorate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GovernorateRequest $request)
    {
        //
        $data = $request->all();
        Governorate::create($data);
        return redirect('dashboard/governorate')->withStatus('governorate added successfully');

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
        $governorate = Governorate::findOrFail($id);
        return view('dashboard.governorate.create',compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GovernorateRequest $request, $id)
    {
        //
        $governorate = Governorate::findOrFail($id);
        $data = $request->all();
        $governorate->update($data);
        return redirect('dashboard/governorate')->withStatus('city updated successfully');

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
        $data = Governorate::findOrFail($id);
        $data->delete();
        return back()->withStatus('governorate deleted succussfully');
    }
}
