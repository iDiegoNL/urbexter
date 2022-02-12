@php
    /* @var Spatie\MediaLibrary\MediaCollections\Models\Media $media */
@endphp

<div class="relative rounded-lg">
    <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" class="w-full cursor-pointer rounded-lg" wire:click="$emit('closeModal')">
    <div class="absolute inset-x-0 -bottom-8 flex items-center justify-center z-50">
        <span class="font-medium">Press on the image to close it</span>
    </div>
</div>
