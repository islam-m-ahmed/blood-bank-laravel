<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(20);
        return view('dashboard.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $post = new Post();
        //all
        $post->title = $request->title;
        $post->content = $request->input('content');
        $post->category_id = $request->category_id;
        //image
        $photo =$request->image;
        $image_name = time().'.'.$photo->getClientoriginalExtension();
        $request->image->move('images/posts',$image_name);
        $post->image = $image_name;

        $post->save();
        return redirect('dashboard/post')->withStatus('post added successfully');

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
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.post.create',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->input('content');
        $post->category_id = $request->category_id;
        //image
        $photo =$request->image;
        if ($photo){
            $image_path = public_path().'images/posts'.$post->photo;
            if (file_exists($image_path)){
                unlink($image_path);
            }
            $image_name = time().'.'.$photo->getClientoriginalExtension();
            $request->image->move('images/posts',$image_name);
            $post->image = $image_name;
        }

        $post->save();
        return redirect('dashboard/post')->withStatus('post updated successfully');
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
        $post = Post::findOrFail($id);
        $image = $post->image;
        if($image){
            $image_path = public_path().'/images/posts/'.$post->image;
            unlink($image_path);
        }
        $post->delete();
        return back()->withStatus('posted deleted successfully');


    }
}
