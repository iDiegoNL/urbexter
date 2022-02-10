@extends('layouts.base')

@section('body')
    <x-app-ui::layouts.base>
        <x-app-ui::navbar full-width>
            <x-slot name="start">
                <x-app-ui::navbar.brand :href="route('home')">
                    {{ config('app.name') }}
                </x-app-ui::navbar.brand>
            </x-slot>

            <x-slot name="desktopMenu">
                <x-app-ui::navbar.desktop.item :href="route('home')" active>
                    Home
                </x-app-ui::navbar.desktop.item>
                <x-app-ui::navbar.desktop.item href="#">
                    Placeholder
                </x-app-ui::navbar.desktop.item>
                <x-app-ui::navbar.desktop.avatar href="#">
                    <x-app-ui::avatar src="https://i.imgur.com/TGeLzZ3.jpg" size="sm" />
                </x-app-ui::navbar.desktop.avatar>
            </x-slot>

            <x-slot name="mobileMenu">
                <x-app-ui::navbar.mobile.item href="#" active>
                    Dashboard
                </x-app-ui::navbar.mobile.item>
                <x-app-ui::navbar.mobile.item href="#">
                    Sites
                </x-app-ui::navbar.mobile.item>
                <x-app-ui::navbar.mobile.item href="#">
                    Teams
                </x-app-ui::navbar.mobile.item>
            </x-slot>
        </x-app-ui::navbar>

        @yield('header')

        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </x-app-ui::layouts.base>
@endsection
