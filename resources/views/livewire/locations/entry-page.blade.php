@php
    /* @var App\Models\Location $location */
@endphp

@section('header')
    <x-app-ui::header background-color="light">
        <x-slot name="heading">
            <div class="flex flex-col">
                <span>
                    {{ Spatie\Emoji\Emoji::countryFlag($location->country) }} {{ $location->name }}
                </span>
                @if($location->status)
                    <span>
                        <x-app-ui::badge class="text-base" :color="$location->status->color"
                                         :icon="$location->status->icon">
                            {{ $location->status->name }}
                        </x-app-ui::badge>
                    </span>
                @endif
            </div>
        </x-slot>

        <x-slot name="subheading">
            Also known as:
            @foreach($location->aliases as $alias)
                <x-app-ui::badge>
                    {{ $alias->name }}
                </x-app-ui::badge>
            @endforeach
        </x-slot>

        <x-slot name="meta">
            <x-app-ui::header.meta-detail>
                <x-slot name="label">
                    Latest visit
                </x-slot>

                2 hours ago
            </x-app-ui::header.meta-detail>

            @if($location->reconverted_year)
                <x-app-ui::header.meta-detail>
                    <x-slot name="label">
                        Reconverted
                    </x-slot>

                    In <b>{{ $location->reconverted_year }}</b>
                </x-app-ui::header.meta-detail>
            @endif

            @if($location->demolished_year)
                <x-app-ui::header.meta-detail>
                    <x-slot name="label">
                        Demolished
                    </x-slot>

                    In <b>{{ $location->demolished_year }}</b>
                </x-app-ui::header.meta-detail>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-app-ui::icon-button label="Share" icon="iconic-share"/>

            <x-app-ui::icon-button label="Add to favourites" icon="iconic-heart"/>

            <x-app-ui::dropdown id="options-dropdown">
                <x-slot name="trigger">
                    <x-app-ui::icon-button
                        label="Report issue"
                        icon="heroicon-o-dots-vertical"
                        x-on:click="open = true"/>
                </x-slot>

                <x-app-ui::dropdown.item icon="iconic-edit">
                    Suggest edit
                </x-app-ui::dropdown.item>

                <x-app-ui::dropdown.separator/>

                <x-app-ui::dropdown.item icon="iconic-trash" color="danger">
                    Report as demolished
                </x-app-ui::dropdown.item>

                <x-app-ui::dropdown.item icon="iconic-refresh" color="danger">
                    Report as reconverted
                </x-app-ui::dropdown.item>
            </x-app-ui::dropdown>
        </x-slot>
    </x-app-ui::header>
@endsection

<div>
    Entry page for {{ $location->name }}
</div>
