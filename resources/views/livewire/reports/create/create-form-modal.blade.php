<form class="relative w-full max-w-7xl p-2 m-auto space-y-2 bg-white shadow rounded-xl">
    <div class="px-4 py-2">
        <x-app-ui::modal.heading>
            Write a new report
        </x-app-ui::modal.heading>
    </div>

    <div class="border-t"></div>

    <div class="px-4 py-2">
        {{ $this->form }}
    </div>

    <div class="border-t"></div>

    <footer class="flex items-center px-4 py-2 space-x-4">
        <x-app-ui::modal.actions>
            <x-app-ui::button wire:click="$emit('closeModal', true)" color="secondary">
                Cancel
            </x-app-ui::button>
            <x-button wire:click="submit" wire:loading.remove>
                Create
            </x-button>

            <x-button
                icon="fad-spinner-third"
                icon-class=" faa-spin animated"
                wire:loading.flex>
                Creating...
            </x-button>
        </x-app-ui::modal.actions>
    </footer>
</form>
