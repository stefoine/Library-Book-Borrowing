<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Left Side Of Navbar -->
<ul class="navbar-nav me-auto">
    @auth
        <li class="nav-item">
            <a class="nav-link" href="{{ route('books.index') }}">Books</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('borrows.index') }}">My Borrows</a>
        </li>
        
        {{-- Show User Management only to Admins --}}
        @if(auth()->user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
            </li>
        @endif
    @endauth
</ul>
        </div>
    </body>
</html>
