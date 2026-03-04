<x-filament-widgets::widget class="fi-wi-top-organizations">
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                Top 3 Organizations
                <x-filament::icon icon="heroicon-o-sparkles" class="h-5 w-5 text-amber-500" />
            </div>
        </x-slot>

        <div class="space-y-4">
            @foreach ($organizations as $index => $organization)
                @php
                    $rank = $index + 1;
                    $isFirst = $rank === 1;
                @endphp
                <div
                    @class([
                        'rounded-lg border p-4',
                        'border-primary-500 bg-primary-500/10' => $isFirst,
                        'border-gray-200 dark:border-gray-700 dark:bg-gray-800/50' => !$isFirst,
                    ])
                >
                    <div class="relative">
                        <span
                            @class([
                                'absolute right-0 top-0 flex h-8 w-8 items-center justify-center rounded text-lg font-bold',
                                'bg-primary-500 text-white' => true,
                            ])
                        >
                            {{ $rank }}
                        </span>
                        <div class="pr-12">
                            <a
                                href="{{ \App\Filament\Resources\Organizations\OrganizationResource::getUrl('edit', ['record' => $organization]) }}"
                                class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                            >
                                {{ $organization->name }}
                            </a>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $organization->invoices_count }} Claims
                            </p>
                            @if ($organization->invoices_count > 0)
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                    {{ $organization->invoices_count }} Invoices
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
