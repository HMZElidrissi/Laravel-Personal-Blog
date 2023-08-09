@extends('components.layout')

@section('title', $post->title)

@section('content')
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                @if ($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="img-fluid rounded-xl">
                @else
                    <img src="https://placehold.co/600x400" alt="Placeholder" class="img-fluid rounded-xl">
                @endif
            </div>

            <div class="col-lg-8">
                <div class="d-none d-lg-flex justify-content-between mb-4">
                    <a href="/" class="text-uppercase transition-colors duration-300 relative inline-flex items-center text-lg text-decoration-none text-dark hover-text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
                        Back to Posts
                    </a>
                    <div class="space-x-2">
                        <x-category-button :category="$post->category"/>
                    </div>
                </div>

                <h1 class="font-weight-bold text-3xl mb-1">{{ $post->title }}</h1>
                <p class="text-muted small mb-4">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>

                {!! $post->body !!}
            </div>
        </div>
    </main>

@endsection
