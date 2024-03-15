<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- title  -->
        <title>@yield('title')</title>
        <!-- title icon  -->
        <link rel="icon" href="{{asset('Application/public/images/settings/websiteIconName'.$settingsAllData->websiteIcon)}}" type=""/>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{URL::to('/')}}/application/public/build/assets/app-ef45d5a4.css"></link>
        <link rel="stylesheet" href="{{URL::to('/')}}/application/public/build/assets/app-dbe23e4c.js"></link>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
