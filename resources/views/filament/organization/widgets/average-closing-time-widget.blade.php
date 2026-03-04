<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Average closing time</x-slot>

        <div class="flex flex-col items-center justify-center py-6">
            <p class="text-4xl font-light text-gray-300">
                {{ $this->getAverageDays() }} days
            </p>
            <div class="mt-4 text-gray-600">
                <x-filament::icon icon="heroicon-o-clock" class="h-8 w-8" />
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
