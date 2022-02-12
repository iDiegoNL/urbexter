@php
    /* @var App\Models\Location $location */
    /* @var App\Models\Location $report */
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
            <x-app-ui::button
                onclick="Livewire.emit('openModal', 'reports.create.create-form-modal', {{ json_encode(['location_id' => $location->id]) }})">
                Write a report
            </x-app-ui::button>

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

<div class="py-4 xl:pt-8 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="max-w-max lg:max-w-7xl mx-auto">
        <div class="relative z-10 mb-8 md:mb-2 md:px-6">
            <div class="text-base max-w-prose lg:max-w-none">
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    About {{ $location->name }}
                </p>
            </div>
        </div>
        <div class="relative">
            <svg class="hidden md:block absolute top-0 right-0 -mt-20 -mr-20" width="404" height="384" fill="none"
                 viewBox="0 0 404 384" aria-hidden="true">
                <defs>
                    <pattern id="95e8f2de-6d30-4b7e-8159-f791729db21b" x="0" y="0" width="20" height="20"
                             patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#95e8f2de-6d30-4b7e-8159-f791729db21b)"/>
            </svg>
            <div class="relative md:px-6">
                <div class="lg:grid lg:gap-6 lg:grid-cols-2">
                    <div class="prose prose-blue prose-lg text-gray-500 lg:max-w-none -my-5">
                        <x-markdown>
                            {{ $location->description }}
                        </x-markdown>
                    </div>
                    @if($location->getFirstMediaUrl() !== '')
                        <img class="w-full rounded-lg cursor-pointer"
                             src="{{ $location->getFirstMediaUrl('default', 'small') }}"
                             alt="{{ $location->name }}"
                             onclick="Livewire.emit('openModal', 'modals.show-media-modal', {{ json_encode(['media_id' => $location->getFirstMedia()->id]) }})">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="border-t border-gray-300">
    <div class="relative max-w-7xl mx-auto pt-8">
        <div class="relative z-10 mb-8 md:mb-2 md:px-6">
            <div class="text-base max-w-prose lg:max-w-none">
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Reports
                </p>
            </div>
        </div>

        <div class="grid gap-5 lg:grid-cols-3 lg:max-w-none p-6">
            @forelse($location->reports as $report)
                <x-app-ui::card
                    class="cursor-pointer"
                    :image="$report->getFirstMediaUrl('default', 'card-thumb') ?: 'https://via.placeholder.com/397x223?text=No+image+available'"
                    :imageAlt="$report->title"
                    onclick="Livewire.emit('openModal', 'reports.show.show-report-modal', {{ json_encode(['report_id' => $report->id]) }})"
                >
                    <x-slot name="heading">
                        {{ $report->title }}
                    </x-slot>

                    <x-slot name="subheading">
                        <p class="break-words">
                            {{ Str::limit($report->plainTextDescription()) }}
                        </p>
                    </x-slot>
                </x-app-ui::card>

                <x-app-ui::empty-state icon="fad-typewriter">
                    <x-slot name="heading">
                        Did you visit this location?
                    </x-slot>

                    <x-slot name="description">
                        Why not write a report about it to share with the community!
                    </x-slot>

                    <x-slot name="actions">
                        <x-app-ui::button
                            size="sm"
                            onclick="Livewire.emit('openModal', 'reports.create.create-form-modal', {{ json_encode(['location_id' => $location->id]) }})">
                            Write a report
                        </x-app-ui::button>
                    </x-slot>
                </x-app-ui::empty-state>

            @empty
                <x-app-ui::empty-state icon="fad-file-magnifying-glass" class="col-span-3" width="7xl" flat>
                    <x-slot name="heading">
                        Sorry to disappoint you!
                    </x-slot>

                    <x-slot name="description">
                        Sadly, we don't have any reports for this location yet. If you have visited this location,
                        consider submitting a report!
                    </x-slot>

                    <x-slot name="actions">
                        <x-app-ui::button
                            size="sm"
                            onclick="Livewire.emit('openModal', 'reports.create.create-form-modal', {{ json_encode(['location_id' => $location->id]) }})">
                            Write a report
                        </x-app-ui::button>
                    </x-slot>
                </x-app-ui::empty-state>
            @endforelse
        </div>
    </div>
</div>
