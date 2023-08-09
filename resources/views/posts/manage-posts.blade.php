@extends('components.layout')

@section('title', 'Manage Posts')

@section('content')
    <div>
        <br/>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button onclick="window.location.href='{{ route('posts.create') }}'" type="button"
                        class="btn btn-primary shadow rounded-pill uppercase mb-4">
                    + New Post
                </button>
                @if ($posts->count() > 0)
                    <div class="shadow">
                        <table class="table table-hover rounded custom-table">
                            <thead class="thead-light text-uppercase">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Published Date</th>
                                <th scope="col" width="200">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-secondary text-white rounded-pill shadow">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow" onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No posts found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
