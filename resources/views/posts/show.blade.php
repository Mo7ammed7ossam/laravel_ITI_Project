@extends('layout.app')

@section('title')
    Show Post
@endsection

@section('content')
    {{-- card --}}

    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title bg-dark text-light p-3 ">Post information</h5>
            <div class="card-text  p-3">

                <div>
                    <span class="fs-3">Title : </span> <span class="fs-5"> {{ $selectedPost['title'] }}
                    </span>
                </div>

                <div>
                    <h2 class="">Description : </h2>
                    <p class=""> {{ $selectedPost['description'] }} </p>
                </div>

            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body ">
            <h5 class="card-title bg-dark text-light p-3 ">Post information</h5>
            <div class="card-text  p-3">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span class="fs-3">Name : </span> <span class="fs-5">
                            {{ $selectedPost->user ? $selectedPost->user->name : "UNKNOWN !!" }} </span>
                    </li>
                    <li class="list-group-item">
                        <span class="fs-3">Email : </span> <span class="fs-5">
                            {{ $selectedPost->user ? $selectedPost->user->email : "UNKNOWN !!" }} </span>
                    </li>
                    <li class="list-group-item">
                        <span class="fs-3">Created At : </span> <span class="fs-5">
                            {{ $selectedPost['created_at'] }} </span>
                    </li>
                </ul>

            </div>
        </div>
    </div>
@endsection
