<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Methods\Helper;
use App\Models\{Client,Token};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash, Mail};
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    // helper in trait use it for responseJson method
    use Helper;
    // login with client
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        //check if login is correct
        $client = Client::where('phone',$request->phone)->first();
        if($client) {
            if (  Hash::check($request->password, $client->password)){
                return $this->responseJson(1,'you are success login',[
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            }else{
                return $this->responseJson(0,'The login data is incorrect');
            }
        }else {
            return $this->responseJson(0,'The login data is incorrect');
        }
    }

    // register with clients
    public  function register(Request $request){
        $validator = validator()->make($request->all(),[
            "name" => "required",
            "phone" => "required",
            "email" => "required| unique:clients",
            "date_of_b" => "required",
            "last_donation_date" => "required",
            "city_id" => "required",
            "password" => "required ",
            "blood_type_id" => "required"
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,'errors',$validator->errors());
        }

        //encrype password
        $request->merge(['password' => bcrypt($request->password)]);

        //create new client
        $client = Client::create($request->all());

        // random api token  for new client
        $client->api_token = Str::random(60);
        if($client->save()){

            // dd($client->city()->governorate_id);
            //record governorate.id with clients.id in client_governorate table  for notification
            $client->governorates()->attach($client->city->governorate_id);

            //record blood_type.id with clients.id in blood_type_client table for notification
            $client->bloodTypes()->attach($request->blood_type_id);

            return $this->responseJson(1,'success',[
                'api_token' => $client->api_token,
                'client' => $client
            ]);
        }else{
            return $this->responseJson(0,'try in anther time');
        }

    }

    // reset password
    public function resetPassword(Request $request){
        $validator = validator()->make($request->all(),[
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $client = Client::where('phone',$request->phone)->first();
        if($client){
            $pin_code = rand(1111,9999);
            $client->pin_code = $pin_code;

            if ($client->save()){
                //send email
                Mail::to($client->email)
//                ->cc($moreUsers) //
                    ->bcc("engislamm1@gmail.com")
                    ->send(new ResetPassword($pin_code));
                return $this->responseJson(1,'check you phone',['code'=>$pin_code]);
            }else{
                return $this->responseJson(0,'try anther time');
            }
        }
        else{
            return $this->responseJson(0,'try anther time');
        }
    }

    // new password
    public function newPassword(Request $request){
        $validator = validator()->make($request->all(),[
            'pin_code' => 'required',
             'password' => 'confirmed'
        ]);

        if($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        //check if pin code is correct
        $client = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();
        if($client){
            $client->password = bcrypt($request->password);
            $client->pin_code=  null;
            if($client->save()){
                return $this->responseJson(1,'you password changed');
            }else{
                return $this->responseJson(1,'errors try in another time');
            }
        }else{
            return $this->responseJson(1,'this code isnt correct');
        }

    }

    //method do get and update profile
    public function profile(Request $request){
        $validator = validator()->make($request->all(),[
            "phone" => ["required", "numeric", Rule::unique('clients')->ignore($request->user()->id)],
            "email" => ["required", "email", Rule::unique('clients')->ignore($request->user()->id)],
//            "name" => "required",
//            "date_of_b" => "required",
//            "last_donation_date" => "required",
//            "city_id" => "required",
            "password" => "required | confirmed ",
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        //bcrypt password and update
        if ($request->password){
            $request->merge(['password',bcrypt($request->password)]);
        }
        $client = $request->user();
        $client->update($request->all());

        return $this->responseJson(1,'data in updated successfully', $client);

    }

    //create token for notification
    public function registerToken(Request $request){
        $validation = validator()->make($request->all(), [
            'token' => 'required',
            'type' =>'required|in:android,ios'
        ]);

        if($validation->fails()) {
            return $this->responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $token = Token::where('token',$request->token);
        if($token){
            $token->delete();
        }
        $request->user()->tokens()->create($request->all());
        return $this->responseJson(1,'success',[
            'token' => $token->first()
        ]);

    }

    //remove token
    public function removeToken(Request $request){
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);

        if($validation->fails()) {
            return $this->responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        Token::where('token',$request->token)->delete();
        return $this->responseJson(1,'success');
    }

}
