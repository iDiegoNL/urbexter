@php
    /* @var App\Models\Location $location */
@endphp

<div>
    <x-app-ui::header background-color="light">
        <x-slot name="heading">
            Locations
        </x-slot>
    </x-app-ui::header>

    <div class="relative max-w-7xl mx-auto pt-8">
        <div class="grid gap-5 lg:grid-cols-3 lg:max-w-none">
            @foreach($locations as $location)
                <x-app-ui::card
                    :image="$location->getImageUrl()"
                    :imageAlt="$location->name"
                >
                    <x-slot name="heading">
                        <a href="{{ route('locations.show', $location->id) }}">
                            {{ Spatie\Emoji\Emoji::countryFlag($location->country) }} {{ $location->name }}
                        </a>
                    </x-slot>

                    <x-slot name="subheading">
                        {{ Str::limit($location->description) }}
                    </x-slot>
                </x-app-ui::card>
            @endforeach
        </div>
    </div>
</div>