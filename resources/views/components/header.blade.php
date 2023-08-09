<nav class="navbar navbar-expand-md navbar-shrink py-3 navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{asset ('assets/img/logo.png')}}" alt="Logo" class="logo">
        </a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                @if (Route::has('login'))
                @auth()
                        <li class="nav-item"><a class="nav-link" href="{{ route('posts.manage') }}">Manage Posts</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="nav-link nav-link-auth btn btn-primary shadow rounded-pill" type="submit">
                                    Log-out
                                </button>
                            </form>
                        </li>
                @else
                        <li class="nav-item">
                                <a class="nav-link nav-link-auth btn btn-primary shadow rounded-pill"
                                        type="submit"
                                        href="{{ route('login') }}">
                                    Log-in
                                </a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
