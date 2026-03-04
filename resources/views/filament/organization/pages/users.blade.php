<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-information-circle" class="h-5 w-5 text-primary-400" />
                <span class="text-sm">
                    Please note: If you need to make changes to the user's account or delete it, please be aware that the process may take some time to complete.
                </span>
            </div>
        </x-slot>
    </x-filament::section>

    {{ $this->table }}
</x-filament-panels::page>
