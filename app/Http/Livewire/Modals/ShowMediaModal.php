<?php

namespace App\Http\Livewire\Modals;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShowMediaModal extends ModalComponent
{
    public ?Media $media;

    public function mount($media_id): void
    {
        $this->media = Media::query()->findOrFail($media_id);
    }

    public function render(): View
    {
        return view('livewire.modals.show-media-modal');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    /**
     * Specify if all other modals should be closed on escape
     *
     * @return bool
     */
    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }

    /**
     * Specify if clicking outside the modal should close it
     *
     * @return bool
     */
    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
