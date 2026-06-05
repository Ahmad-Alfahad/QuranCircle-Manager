<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- <div style="margin-bottom:10px; color:gray; ">
    @yield('breadcrumbs')
</div> -->

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen ">


        <div class="flex min-h-screen bg-gray-200 rounded ">
            <div class="w-64 bg-gray-100 shadow sticky top-0 h-screen">
                @include('layouts.sidebar')
            </div>

            <div class="flex-1 rounded p-6 m-4 bg-white shadow">

                <!-- Page Heading -->
                @isset($header)
                <header class="bg-gray-100 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                        {{ $header }}
                    </div>
                </header>
            @endisset
                <!-- Sidebar -->

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
</body>

</html>