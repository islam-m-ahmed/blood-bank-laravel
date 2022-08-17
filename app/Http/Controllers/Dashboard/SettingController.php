<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function edit()
    {
        //
        $setting = Setting::first();
        return view('dashboard.setting.index',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $message = [
            'fb_link' => ['required','URL'],
            'youtube_link' => ['required','URL'],
            'insta_link' => ['required','URL'],
            'tw_link' => ['required','URL'],
            'email' => ['required','email'],
            'phone' => ['required'],
            'about_app' => ['required'],
            'notification_settings_text' => ['required','string'],
        ];
        $this->validate($request,$message);
        //

        $setting = Setting::first();
        if ($setting){
            $setting->update($request->all());
        }else{
            Setting::create($request->all());
        }
        return back()->withStatus('settings updated successfully');
    }


}
