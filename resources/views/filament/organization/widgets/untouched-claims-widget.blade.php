<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span>Untouched claims in 48 Hrs</span>
                <a href="{{ $this->getViewAllUrl() }}"
                   class="fi-btn fi-btn-size-sm inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-semibold bg-primary-500 text-white hover:bg-primary-600 transition">
                    View All
                </a>
            </div>
        </x-slot>

        <div class="divide-y divide-white/10">
            @forelse ($this->getClaims() as $claim)
                <div class="flex items-start justify-between py-4 first:pt-0 last:pb-0">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-white uppercase">
                            {{ $claim->claimant }}
                        </p>
                        <p class="text-xs {{ $this->getStatusColor($claim->status?->name ?? '') }}">
                            {{ $claim->status?->name ?? '—' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Updated {{ $claim->updated_at?->format('M d, Y') }}
                        </p>
                    </div>
                    <a href="{{ $this->getViewAllUrl() }}"
                       class="shrink-0 rounded-lg border border-gray-600 px-4 py-1.5 text-xs font-medium text-gray-300 hover:bg-white/5 transition">
                        Manage
                    </a>
                </div>
            @empty
                <div class="py-8 text-center text-sm text-gray-500">
                    No untouched claims
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
