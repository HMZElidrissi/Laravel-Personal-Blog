@extends('components.layout')

@section('title', 'Hamza El Idrissi')

@section('content')
    <header>
        <div class="container pt-4 pt-xl-5">
            <div class="row">
                <div class="col-md-8 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h1 class="display-4 fw-bold mb-3">New post every&nbsp;<span class="underline">sometimes</span>.</h1>
                        <p class="fs-5 text-muted mb-5">by Hamza EL IDRISSI</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Category -->
                <div class="col-md-4 col-9 d-flex justify-content-end mb-3 mb-md-0">
                    <form action="{{ route('search') }}" method="GET">
                        <label for="categorySelect" class="sr-only">Category</label>
                        <select class="form-select rounded-pill" name="category" id="categorySelect" onchange="this.form.submit();">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($categoryId == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <!-- Include the selected category ID as a hidden input -->
                        <input type="hidden" name="selected_category" value="{{ $categoryId }}">
                    </form>
                </div>
                <!-- Search -->
                <div class="col-md-6 col-12">
                    <form action="{{ route('search') }}" method="GET" class="input-group" id="searchForm">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="query" placeholder="Find something ..." aria-label="Search" aria-describedby="searchButton" id="searchInput">
                            <input type="hidden" name="category" value="{{ $categoryId }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container py-4">
        <div class="row">
            @if ($posts->count())
                @foreach($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            @else
                <p class="text-center fs-5 text-muted mb-5">No posts yet. Please check back later.</p>
            @endif
        </div>
    </div>
@endsection
