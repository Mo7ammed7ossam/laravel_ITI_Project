<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public $posts = [
        ['id' => 1, 'title' => 'first post', 'description' => 'aya 7age', 'posted_by' => 'mohamed Alwakiel', 'created_at' => '10/10/2020'],

        ['id' => 2, 'title' => 'second post', 'description' => 'aya 7age', 'posted_by' => 'sayeed ali', 'created_at' => '10/10/2020'],

        ['id' => 3, 'title' => 'third post', 'description' => 'aya 7age', 'posted_by' => 'mohamed khaled', 'created_at' => '10/10/2020']
    ];



    public function index()
    {
        return view('posts.index', [
            'posts' =>  $this->posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //fetch request data
        $requestData = request()->all();

        // create new ID
        $newID = sizeof($this->posts) + 1;

        //store request data in db
        $newPost =  ['id' => $newID, 'title' => $requestData['title'], 'description' => $requestData['description'], 'posted_by' => $requestData['Post_Creator'], 'created_at' => '10/10/2020'];

        // store new post on array
        array_push($this->posts, $newPost);

        //redirection to posts.index
        return view('posts.index', [
            'posts' =>  $this->posts
        ]);
    }

    public function show($postID)
    {

        foreach ($this->posts as $post) :

            if ($post['id'] == $postID) :
                $selectedPost =  ['id' => $postID, 'title' => $post['title'], 'description' => $post['description'], 'posted_by' => $post['posted_by'], 'created_at' => $post['created_at']];
            endif;

        endforeach;

        return view('posts.show', [
            'selectedPost' => $selectedPost
        ]);
    }

    public function edit($postID)
    {

        foreach ($this->posts as $post) :

            if ($post['id'] == $postID) :
                $selectedPost =  ['id' => $postID, 'title' => $post['title'], 'description' => $post['description'], 'posted_by' => $post['posted_by'], 'created_at' => $post['created_at']];
            endif;

        endforeach;


        return view('posts.edit', [
            'selectedPost' => $selectedPost
        ]);
    }

    public function update($postID)
    {
        //fetch request data
        $requestData = request()->all();

        foreach ($this->posts as $i=>$post):

            if ($post['id'] == $postID) :
                $this->posts[$i]['title'] = $requestData['title'];
                $this->posts[$i]['description'] = $requestData['description'];
                $this->posts[$i]['posted_by'] = $requestData['Post_Creator'];
            endif;

        endforeach;

        //redirection to posts.index
        return view('posts.index', [
            'posts' =>  $this->posts
        ]);
    }

    public function destroy($postID)
    {

        foreach ($this->posts as $i=>$post):

            if ($post['id'] == $postID) :
                unset($this->posts[$i]);
            endif;

        endforeach;

        //redirection to posts.index
        return view('posts.index', [
            'posts' =>  $this->posts
        ]);
    }

}
