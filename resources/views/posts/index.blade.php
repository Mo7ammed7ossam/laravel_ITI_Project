@extends('layout.app')

@section('title')
    All Posts
@endsection

@section('content')


    <div class="container mt-2">

        <div class="text-center my-3">
            <a class="btn btn-success py-2 px-4 fs-4" href="{{ route('posts.create') }}" role="button">
                Create
            </a>
        </div>


        <div class="mt-3">
            <table class="table  mx-auto text-center table-bordered table-striped">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">content</th>
                        <th scope="col">Posted By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post['id'] }}</th>
                            <td>{{ $post['title'] }}</td>
                            <td>{{ $post['description'] }}</td>
                            <td>{{ $post['posted_by'] }}</td>
                            <td>{{ $post['created_at'] }}</td>

                            <td class="d-flex justify-content-around">

                                <a class="btn btn-primary" href="{{ route('posts.show', $post['id']) }}" role="button">
                                    Show
                                </a>

                                <a class="btn btn-dark" href="{{ route('posts.edit', $post['id']) }}" role="button">
                                    Update
                                </a>

                                <form action="{{ route('posts.destroy', $post['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div>
@endsection
