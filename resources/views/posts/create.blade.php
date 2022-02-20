@extends('layout.app')

@section('title')
    Create Post
@endsection

@section('content')
    <form class="mt-5 w-50 mx-auto" action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
        </div>


        <div class="mb-3">
            <label class="form-label">Post Creator</label>

            <select name="user_id" class="form-control">

                <option class="text-center"> -- select creator -- </option>

                {{-- loop on users to show them in drop down list --}}
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach

            </select>

        </div>


        <button type="submit" class="btn btn-success py-2 px-4">Submit</button>
    </form>
@endsection
