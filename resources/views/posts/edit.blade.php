@extends('layout.app')

@section('title')
    Update Post
@endsection

@section('content')
    <form class="mt-5 w-50 mx-auto" action="{{ route('posts.update', $selectedPost['id']) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" value="{{ $selectedPost['title'] }}" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="5">
                {{ $selectedPost['description'] }}
            </textarea>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Post Creator</label>
            <input type="text" name="Post_Creator" value="{{ $selectedPost['posted_by'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-success py-2 px-4">Submit</button>
    </form>
@endsection