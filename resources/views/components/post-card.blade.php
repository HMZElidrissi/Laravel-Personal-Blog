@props(['post'])

<div class="col-md-6 mb-4"> <!-- Set the column width to half of the grid (md=medium breakpoint) -->
    <div class="card shadow d-flex justify-content-center p-4 custom-card">
        <div class="card-body">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Blog Post illustration" class="card-img-top rounded-xl">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="space-x-2">
                    <x-category-button :category="$post->category" />
                </div>
            </div>
            <span class="text-muted small">Published <time>{{ $post->created_at->diffForHumans() }}</time></span>
            <h3 class="card-title clamp">
                <strong>
                    <a href="/posts/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </strong>
            </h3>
            <div class="card-text excerpt-text-sm">
                {!! $post->excerpt !!}
            </div>
        </div>
        <a class="btn btn-sm px-0" href="/posts/{{ $post->slug }}">
            Read More&nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
            </svg>
            <br>
        </a>
    </div>
</div>
