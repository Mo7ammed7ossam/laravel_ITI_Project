<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(8);
        return PostResource::collection($posts);
    }

    public function show($postID)
    {
        $post = Post::find($postID);
        return new PostResource($post);
    }

    public function store(PostRequest $postRequest)
    {
        $requestData = request()->all();
        $post = Post::create($requestData);
        return new PostResource($post);
    }

}
