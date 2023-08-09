<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Log-in</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}} ">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&amp;display=swap">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <section class="py-md-5 my-5">
        <div class="container py-md-2">
            <div class="row">
                <div class="col-md-6 text-center">
                    <a href="/">
                        <img class="img-fluid w-100" src="{{asset('assets/img/illustrations/login.svg')}}" alt="login">
                    </a>
                </div>
                <div class="col-md-5 col-xl-4 text-center text-md-start">
                    <h2 class="display-6 fw-bold mb-5">
                        <span class="underline pb-1">
                            <strong>Login</strong>
                        </span>
                    </h2>
                    @if(session('error'))
                        <div style="color: red;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="post" action="/login" data-bs-theme="light">
                        @csrf
                        <div class="mb-3">
                            <input class="shadow form-control" type="email" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input class="shadow form-control" type="password" name="password" placeholder="Password">
                        </div>
                        <div>
                            <button class="btn btn-primary rounded-pill shadow" type="submit">
                                Log-in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset ('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/js/startup-modern.js') }}"></script>
</body>
</html>
