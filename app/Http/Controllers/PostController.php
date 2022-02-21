<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {

        // using Paginating Eloquent
        $posts = Post::paginate(8);

        // $posts = Post::all();   // or can use get()
        return view('posts.index', [
            'posts' =>  $posts
        ]);
    }

    public function create()
    {
        $users = User::all();   // fetch users from user table

        return view('posts.create', [
            'users' => $users
        ]);
    }

    public function store(PostRequest $postRequest)
    {
        //fetch request data
        $requestData = request()->all();

        // store new data into data base
        Post::create([
            'title' => $requestData['title'],
            'description' => $requestData['description'],
            'user_id' => $requestData['user_id']
        ]);

        //redirection to posts.index
        return redirect()->route('posts.index');

    }

    public function show($postID)
    {

        $post = Post::find($postID);
        // or post::where('id', $postID)->first();

        return view('posts.show', [
            'selectedPost' => $post
        ]);
    }

    public function edit($postID)
    {
        $users = User::all();   // fetch users from user table

        $post = Post::find($postID);

        return view('posts.edit', [
            'selectedPost' => $post,
            'users' => $users
        ]);
    }

    public function update(PostRequest $postRequest, $postID)
    {
        // validation 
       
        //fetch request data
        $requestData = request()->all();

        // update new data into data base
        Post::find($postID)->update([
            'title' => $requestData['title'],
            'description' => $requestData['description'],
            'user_id' => $requestData['user_id']
        ]);

        //redirection to posts.index
        return redirect()->route('posts.index');
    }

    public function destroy($postID)
    {
        $requestData = request()->all();

        if($requestData['delete'] == "delete"):

            Post::find($postID)->delete();
            return redirect()->route('posts.index');

        elseif($requestData['delete'] == "deleteforEver"):

            Post::withTrashed()->find($postID)->forceDelete();
            return redirect()->route('posts.archive');

        endif;

        //redirection to posts.index
        return redirect()->route('posts.index');

    }

    public function archive()
    {

        // using Paginating Eloquent
        $posts = Post::onlyTrashed()->get();

        // $posts = Post::all();   // or can use get()
        return view('posts.archive', [
            'posts' =>  $posts
        ]);
    }

    public function restore($postID)
    {
        Post::withTrashed()->find($postID)->restore();
        return redirect()->route('posts.archive');
    }


}
