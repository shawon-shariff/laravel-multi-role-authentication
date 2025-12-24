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
    <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="h-screen flex overflow-hidden">

        <!-- Left Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg" style="background-color: #172435; flex-shrink: 0;">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/demo_images/playground.ai__1_-removebg-preview.png') }}" alt="logo"
                        style="padding: 5px 20px;height: 70px;">
                </a>
            </div>
            <div class="px-6">
                <nav>
                    <ul>
                        <!-- Navigation Links -->
                        <li class="mt-2 mb-2">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link :href="route('view.transformation')" :active="request()->routeIs('view.transformation')">
                                {{ __('Transformation Center') }}
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link :href="route('view.media')" :active="request()->routeIs('view.media')">
                                {{ __('Media Gallery') }}
                            </x-nav-link>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow flex-shrink-0">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content (Scrollable) -->
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>

    </div>
    <script src="{{ asset('assets/js/imageHandler.js') }}"></script>
</body>


</html>
