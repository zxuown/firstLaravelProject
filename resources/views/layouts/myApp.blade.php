<?php
$languages = [
    'en' => __('site.language.en'),
    'uk' => __('site.language.uk'),
];
$appLocale = app()->getLocale()
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @stack('head_styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Scripts -->
    @stack('head_scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <select class="form-select language-change" aria-label="Language">
                            @foreach($languages as $key => $language)
                            <option {{$appLocale===$key ? 'selected' : null}} value="{{$key}}">{{$language}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="nav-item">
                        <div class="container-fluid">
                            <!-- ... -->
                            <form class="d-flex" action="{{ route('home.search') }}" method="GET">
                                <input class="form-control me-2" type="search"
                                    placeholder="{{__('site.action.search')}}" aria-label="Search" name="query">
                                <button class="btn btn-outline-success"
                                    type="submit">{{__('site.action.search')}}</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            @auth
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    @stack('scripts')
    <script>
        $('.language-change').on('change', (e) => {
            let selected = $(e.target).val()
            fetch(`/change-language/${selected}`)
                .then(r => r.json())
                .then(data => {
                    if (data.ok && data.language !== '{{$appLocale}}') {
                        window.location.reload()
                    }
                })

        })
    </script>
</body>

</html>