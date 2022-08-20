<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Methods\Helper;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    use Helper;
    public function index(Request $request){
        //auth with client
//        $client = Client::first();
//        auth('client-web')->login($client);
        //POSTS
        $posts = Post::all()->take(6);
        // to check if favourite or not
        foreach ($posts as $post){

            if (auth('client-web')->user()){
                $client = auth('client-web')->user()->id;
                if ($post->clients()->where('client_id',$client)->first()){
                    $post->is_favourite = true;
                };
            }

        }
        //DONATION REQUEST
        $donations = DonationRequest::where(function ($q)use($request){
            if ($request->has('search_blood_type')){
                $q->where('blood_type_id',$request->search_blood_type);
            }
        })->where(function ($q) use($request){
            if ($request->has('search_governorate')){
                $city = City::where('governorate_id',$request->search_governorate)->pluck('id');
                $q->where('city_id',$city);
            }
        })->paginate(5);
        return view('front.index',compact('posts','donations'));
    }

    public function aboutUs(){
        return view('front.about-us');
    }

    public function article($id){
        $post = Post::findOrFail($id);
        $posts = Post::all()->take(6);
        return view('front.article',compact('post','posts'));
    }

    public function donationRequest($id){
        $donation = DonationRequest::findOrFail($id);
        return view('front.donation_request',compact('donation'));
    }

    public function donationRequests(Request $request){
        $donations = DonationRequest::where(function ($q)use($request){
            if ($request->has('search_blood_type')){
                $q->where('blood_type_id',$request->search_blood_type);
            }
        })->where(function ($q) use($request){
            if ($request->has('search_governorate')){
                $city = City::where('governorate_id',$request->search_governorate)->pluck('id');
                $q->where('city_id',$city);
            }
        })->paginate(5);
        return view('front.donation_requests',compact('donations'));
    }

    public function toggleFavourite(Request $request){
        $favourite = $request->user()->posts()->toggle($request->post_id);
        return $this->responseJson(1,'success',$favourite);
    }

    public function contact() {

        return view('front.contact');
    }

    public function contactSend(Request $request) {

        $rules = [
            'title' => 'required',
            'message' => 'required'
        ];

        $this->validate($request, $rules);

       Contact::create([
            'title' => $request->title,
            'message' => $request->message,
            'client_id' => $request->id
        ]);

        return back()->withStatus('message send successfully');
    }



}
