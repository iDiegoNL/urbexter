@extends('layouts.app')

@section('header')

@endsection

@section('content')
{{--    <div>--}}
{{--        <x-app-ui::header background-color="light">--}}
{{--            <x-slot name="heading">--}}
{{--                Latest reports--}}
{{--            </x-slot>--}}

{{--            <x-slot name="actions">--}}
{{--                <x-app-ui::button icon="iconic-plus">--}}
{{--                    Create new report--}}
{{--                </x-app-ui::button>--}}
{{--            </x-slot>--}}
{{--        </x-app-ui::header>--}}

{{--        Reports here--}}
{{--    </div>--}}

    <div>
        <x-app-ui::header background-color="light">
            <x-slot name="heading">
                Locations
            </x-slot>
        </x-app-ui::header>

        <div class="relative max-w-7xl mx-auto pt-8">
            <div class="grid gap-5 lg:grid-cols-3 lg:max-w-none">
                <x-app-ui::card
                    image="https://i.imgur.com/N8COH7k.png"
                    imageAlt="Big Sur"
                >
                    <x-slot name="heading">
                        Sanatorium du Basil
                    </x-slot>

                    <x-slot name="subheading">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde qui non repudiandae.
                    </x-slot>
                </x-app-ui::card>
            </div>
        </div>
    </div>
@endsection
