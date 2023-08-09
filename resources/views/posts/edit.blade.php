@extends('components.layout')

@section('title', 'New Post')

@section('content')
    <div>
        <br/>
    </div>
    <div class="container">
        <div class="col-md-12">
            <a href="{{ route('posts.manage') }}" class="text-uppercase transition-colors duration-300 relative inline-flex items-center text-lg text-decoration-none text-dark hover-text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
                Back to Posts
            </a>
        </div>
        <div class="row shadow mt-4">
            <div class="custom-box mb-4">
                # Edit
            </div>
            <div class="col-md-12">
                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row custom-form-group">
                        <div class="col">
                            <label for="title">Title:</label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $post->title) }}" required
                                   placeholder="Title"
                            >
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id', $post->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row custom-form-group">
                        <div class="col">
                            <label for="slug">Slug:</label>
                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $post->slug) }}" required
                                   placeholder="Slug"
                            >
                            @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="thumbnail">Thumbnail:</label>
                            @if ($post->thumbnail)
                                <!-- Display the existing thumbnail if it exists -->
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="img-thumbnail">
                                </div>
                                <p class="text-muted mb-2">To change the thumbnail, upload a new image below:</p>
                            @endif
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                            @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group custom-form-group">
                        <label for="excerpt">Excerpt:</label>
                        <textarea name="excerpt" id="excerpt" rows="3" placeholder="Excerpt" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group custom-form-group mb-4">
                        <label for="body">Body:</label>
                        <textarea name="body" id="body" rows="8" placeholder="Body" class="form-control @error('body') is-invalid @enderror" required>{{ old('body', $post->body) }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end px-3">
                        <button type="submit" class="btn btn-sm btn-primary rounded-pill mb-4">
                            Publish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
