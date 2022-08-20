<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function clientRegister()
    {
        return view('front.register');
    }
    public function clientSave(Request $request){
        $rules = [
            "name" => "required",
            "phone" => "required",
            "email" => "required| unique:clients",
            "date_of_b" => "required",
            "last_donation_date" => "required",
            "city_id" => "required",
            "password" => "required | confirmed ",
            "blood_type_id" => "required"
        ];
        $this->validate($request,$rules);
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        // random api token  for new client
        $client->api_token = Str::random(60);
        if($client->save()){
            //record governorate.id with clients.id in client_governorate table  for notification
            $client->governorates()->attach($client->city->governorate_id);

            //record blood_type.id with clients.id in blood_type_client table for notification
            $client->bloodTypes()->attach($request->blood_type_id);

            return redirect('/')->withStatus('client added sucess');

        }else{
            return back()->withStatus('please try again');
        }

    }
    //login
    public function clientLogin(){
        return view('front.login');
    }

     public function checkLogin(Request $request){
        $rule = [
            'phone' => 'required',
            'password' => 'required'
        ];
        $message = [
            'phone' => 'your phone or password dont match',
            'password' => 'your phone or password dont match'
        ];
        $this->validate($request,$rule,$message);
        $client = Client::where('phone',$request->phone)->first();
        if ($client){
            if (Hash::check($request->password, $client->password)){
                Auth::guard('client-web')->attempt($request->only('password','phone'));
                return redirect('/');
            }
        }else{
            return back()->withStatus('error, try again on anthor time');
        }
     }

     //logout
    public function clientLogout(){
        auth()->guard('client-web')->logout();
        return back();
    }


}
