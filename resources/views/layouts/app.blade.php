<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @vite(['resources/js/app.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="emailNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Emails
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="emailNavbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('email.import') }}">Import emails</a></li>
                                <li><a class="dropdown-item" href="{{ route('email.create') }}">Add email</a></li>
                                <li><a class="dropdown-item" href="{{ route('email.index') }}">All emails</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="listNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lists
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="listNavbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('list.import') }}">Import list</a></li>
                                <li><a class="dropdown-item" href="{{ route('list.index') }}">All lists</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="templateNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Templates
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="templateNavbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('template.create') }}">Create template</a></li>
                                <li><a class="dropdown-item" href="{{ route('template.index') }}">All templates</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('error.index') }}">Error logs</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>