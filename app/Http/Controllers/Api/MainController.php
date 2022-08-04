<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{BloodType, Category, City, Contact, DonationRequest, Governorate, Notification, Post, Setting, Token};
use Illuminate\Http\{JsonResponse, Request};
use App\Methods\Helper;


class MainController extends Controller
{

    use Helper;

    public function governorates(): JsonResponse
    {
        $governorates = Governorate::all();
        return $this->responseJson(1,'success', $governorates);
    }

    public function cities(Request $request): JsonResponse
    {
        $cities = City::where(function ($query) use($request){
            if ($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }
        })->get();
        return $this->responseJson(1, 'success', $cities);
    }

    public function bloodTypes(): JsonResponse
    {
        $blood_types = BloodType::all();
        return $this->responseJson(1,'success', $blood_types);
    }

    public function categories(): JsonResponse
    {
        $categories = Category::all();
        return $this->responseJson(1,'success',$categories);
    }

    //all const text
    public function settings(): JsonResponse
    {
        $setting = Setting::all();
        return $this->responseJson(1,'success', $setting);
    }

    // record contact from client
    public function contacts(Request $request){
        $validator = validator()->make($request->all(),[
            'title' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $contacts = Contact::create($request->all());
        return $this->responseJson(1,'contact saved successfully',$contacts);
    }

    //return all posts
    public  function posts(Request $request){
         $posts = Post::where(function ($query) use($request){
             if($request->has('category_id')){
                 $query->where('category_id', $request->category_id);
             }
         })->get();
         return $this->responseJson(1,'done',$posts);
    }

    //return one post
    public function post(Request $request){
        $post = Post::find($request->id);
        if($post){
            return $this->responseJson(1,'done',$post);
        }else{
            return $this->responseJson(0,'try in anther time please');
        }
   }

   //toggle favourites
    public function favourite(Request $request){

        $validator = validator()->make($request->all(),[
            'post_id' => 'required | exists:posts,id'
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        // toggle favourite
        $favourite = $request->user()->posts()->toggle($request->post_id);

        return $this->responseJson(1,'success',$favourite);

    }

    //return my favourites
    public function myFavourites(Request $request): JsonResponse
    {
        $my_favorite = $request->user()->posts;
        return $this->responseJson(1,'your favourites',$my_favorite);
    }

    //notifications content
    public function notifications(){
        $notifications = Notification::latest()->get();
        return $this->responseJson(1,'lodded',$notifications);
    }

    //notification settings you can change blood type and your city
    public function notificationSettings(Request $request){
        $validator = validator()->make($request->all(),[
            'blood_type_id' => 'exists:blood_types,id',
            'governorate_id' => 'exists:governorate,id'
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        if ($request->has('blood_type_id')){
            $blood_type = $request->user()->bloodTypes()->syncWithoutDetaching($request->blood_type_id);
        }

        if ($request->has('governorate_id')){
            $governorate_id = $request->user()->governorates()->syncWithoutDetaching($request->governorate_id);
        }
        return $this->responseJson(1,'data updated successfully');

    }

    //get notification settings
    public function getNotificationSettings(Request $request){
        return $this->responseJson(1,'notification settings',[
            'blood_type_id' => $request->user()->bloodTypes()->pluck('blood_type_id')->toArray(),
            'governorate_id' => $request->user()->governorates()->pluck('governorate_id')->toArray()
        ]);
    }

    //create donation requests
    public function createDonationRequest(Request $request){
        $validator = validator()->make($request->all(),[
            'patient_name' => 'required',
            'patient_age' => 'required:digits',
            'city_id' => 'required|exists:cities,id',
            'blood_type_id' => 'required',
//            |unique:donation_requests,patient_phone
            'patient_phone' => 'required',
            'hospital_address' => 'required',
            'bags_num' => 'required:digits'
        ]);

        if ($validator->fails()){
            return $this->responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        //create donation request
        $donationRequest = $request->user()->donationRequests()->create($request->all());

        // find clients suitable for this donation requests and return id
        $clients = $donationRequest->city->governorate->clients()->whereHas('bloodTypes',function ($query) use($donationRequest){
            $query->where('blood_types.id',$donationRequest->blood_type_id);
        })->pluck('clients.id')->toArray();

        if (count($clients) > 0){
            //create notification
            $notification = $donationRequest->notifications()->create([
                'title' => 'يوجد حاله تبرع قريبه الان',
                'content' => $donationRequest->bloodType->name.'فصيله '
            ]);

            //attach clients for each notifications one notification for all clients
            $notification->clients()->attach($clients);

            //get token
            $tokens = Token::whereIn('client_id',$clients)->where('token','!=',null)->pluck('token')->toArray();
            if (count($tokens) > 0){
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                $send = $this->notifyByFirebase($title, $body, $tokens,$data);
                info("firebase result".$send);
            };

        }
            return $this->responseJson(1,'donation added successfully',$donationRequest);

    }

}
