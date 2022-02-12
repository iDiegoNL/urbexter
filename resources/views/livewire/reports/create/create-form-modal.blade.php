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
            <x-app-ui::button wire:click="$emit('closeModal')" color="secondary">
                Cancel
            </x-app-ui::button>
            <x-app-ui::button wire:click="submit">
                Create
            </x-app-ui::button>
        </x-app-ui::modal.actions>
    </footer>
</form>
