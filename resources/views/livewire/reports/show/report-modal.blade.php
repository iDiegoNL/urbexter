@php
    /* @var App\Models\Location $report */
@endphp

<div class="text-left overflow-hidden rounded-lg">
    <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
        <button type="button"
                wire:click="$emit('closeModal')"
                class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="sr-only">Close</span>
            <x-heroicon-o-x class="h-6 w-6"/>
        </button>
    </div>
    <div class="bg-white pt-5 px-5">
        <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $report->title }}</h3>
                <div class="prose prose-blue max-w-none">
                    <x-markdown>
                        {{ $report->description }}
                    </x-markdown>
                </div>

                @if($report->getMedia()->count())
                    <div class="border-t pb-8"></div>

                    <ul role="list"
                        class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 mb-5">
                        @foreach($report->getMedia() as $media)
                            <li class="relative">
                                <div
                                    class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                                    <img
                                        src="{{ $media->getUrl('thumb') }}"
                                        alt="" class="object-cover pointer-events-none group-hover:opacity-75">
                                    <button
                                        type="button"
                                        onclick="Livewire.emit('openModal', 'modals.show-media-modal', {{ json_encode(['media_id' => $media->id]) }})"
                                        class="absolute inset-0 focus:outline-none"
                                    >
                                        <span class="sr-only">View full-size image</span>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-gray-50 px-5 py-3 flex justify-between">
        @php
            $previousReport = $report->previous(relationName: 'location', relationId: $report->location->id);
            $nextReport = $report->next(relationName: 'location', relationId: $report->location->id);
        @endphp
        <div class="flex space-x-3">
            @if($previousReport)
                <x-app-ui::button
                    wire:click="$emit('openModal', 'reports.show.show-report-modal', {{ json_encode(['report_id' => $previousReport->id]) }})"
                    icon="heroicon-s-chevron-left"
                    icon-position="before"
                >
                    Previous report
                </x-app-ui::button>
            @endif
        </div>

        <div class="flex items-center space-x-3">
            @if($nextReport)
                <x-app-ui::button
                    wire:click="$emit('openModal', 'reports.show.show-report-modal', {{ json_encode(['report_id' => $nextReport->id]) }})"
                    icon="heroicon-s-chevron-right"
                    icon-position="after"
                >
                    Next report
                </x-app-ui::button>
            @endif
        </div>
    </div>
</div>
