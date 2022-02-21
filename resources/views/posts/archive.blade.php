@extends('layouts.app')

@section('title')
    Archive Posts
@endsection

@section('content')
    <div class="container mt-5">


        <div class="mt-3">
            <table class="table mx-auto text-center table-bordered table-striped">

                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Posted By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        {{-- @dd($post->user,$post->user()) --}}
                        {{-- @dd($post->user,$post->changedName) --}}
                        <tr>
                            <th scope="row">{{ $post['id'] }}</th>
                            <td>{{ $post['title'] }}</td>

                            <td>{{ $post->user ? $post->user->name : 'Not Found !' }}</td>

                            <td>{{ $post['created_at']->isoFormat('YYYY-MM-D') }}</td>

                            <td class="d-flex justify-content-around">

                                <form action="{{ route('posts.restore', $post['id']) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary"
                                        onclick="return confirm('Are you sure you want to delete this record finally ?')"
                                        type="submit">
                                        Restore
                                    </button>
                                </form>

                                <form action="{{ route('posts.destroy', $post['id']) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this record ?')"
                                        type="submit" name="delete" value="deleteforEver">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-center">
            {{-- {{ $posts->links() }} --}}
        </div>

    </div>
@endsection
