<x-filament-panels::page>
    <div x-data="{ activeTab: 'one' }" class="space-y-6">
        {{-- Your subscription --}}
        <x-filament::section>
            <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 1.5rem;">Your subscription</h3>

            {{-- Tabs --}}
            <div style="display: flex; justify-content: center; gap: 2rem; margin-bottom: 2rem;">
                <button
                    @click="activeTab = 'one'"
                    :style="activeTab === 'one'
                        ? 'padding: 0.5rem 1.5rem; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; border-bottom: 2px solid #f59e0b; background: none; border-top: none; border-left: none; border-right: none; cursor: pointer;'
                        : 'padding: 0.5rem 1.5rem; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 2px solid transparent; background: none; border-top: none; border-left: none; border-right: none; cursor: pointer;'"
                >
                    One Location Plan
                </button>
                <button
                    @click="activeTab = 'multiple'"
                    :style="activeTab === 'multiple'
                        ? 'padding: 0.5rem 1.5rem; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; border-bottom: 2px solid #f59e0b; background: none; border-top: none; border-left: none; border-right: none; cursor: pointer;'
                        : 'padding: 0.5rem 1.5rem; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 2px solid transparent; background: none; border-top: none; border-left: none; border-right: none; cursor: pointer;'"
                >
                    Multiple Location Plan
                </button>
            </div>

            {{-- One Location Plan --}}
            <div x-show="activeTab === 'one'">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; max-width: 680px; margin: 0 auto;">
                {{-- Monthly --}}
                <div style="border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 2rem; text-align: center;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; margin-bottom: 0.75rem;">Monthly Subscription</h4>
                    <p style="font-size: 2rem; font-weight: 700; color: #f59e0b;">$299.00</p>
                    <p style="font-size: 0.8rem; color: #f59e0b; margin-bottom: 1.5rem;">per month</p>
                    <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 1.25rem;">
                    <ul style="list-style: none; padding: 0; margin: 0; text-align: left; space-y: 0.5rem;">
                        @foreach(['Unlimited Users', 'Unlimited Claims', 'Daily tracking of claims', 'Close Ratio', 'Average Days to Close', 'Average Supplement Dollar Increase'] as $feature)
                            <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #e2e8f0; padding: 0.25rem 0;">
                                <span style="color: #f59e0b; font-weight: 700;">&#10003;</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <p style="font-size: 0.75rem; color: #475569; margin-top: 1rem; font-style: italic;">16% savings (2 free months)</p>
                    <button style="margin-top: 1.25rem; width: 100%; padding: 0.65rem 1rem; background: #f59e0b; color: #1e293b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border: none; border-radius: 0.5rem; cursor: pointer;">
                        Switch to This
                    </button>
                </div>

                {{-- Yearly --}}
                <div style="border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 2rem; text-align: center;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; margin-bottom: 0.75rem;">Yearly Subscription</h4>
                    <p style="font-size: 2rem; font-weight: 700; color: #f59e0b;">$2,999.00</p>
                    <p style="font-size: 0.8rem; color: #f59e0b; margin-bottom: 1.5rem;">per year</p>
                    <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 1.25rem;">
                    <ul style="list-style: none; padding: 0; margin: 0; text-align: left;">
                        @foreach(['Unlimited Users', 'Unlimited Claims', 'Daily tracking of claims', 'Close Ratio', 'Average Days to Close', 'Average Supplement Dollar Increase'] as $feature)
                            <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #e2e8f0; padding: 0.25rem 0;">
                                <span style="color: #f59e0b; font-weight: 700;">&#10003;</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <p style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; color: #f59e0b; margin-top: 1rem;">
                        <span style="font-weight: 700;">&#10003;</span>
                        16% savings (2 free months)
                    </p>
                    <button style="margin-top: 1.25rem; width: 100%; padding: 0.65rem 1rem; background: #f59e0b; color: #1e293b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border: none; border-radius: 0.5rem; cursor: pointer;">
                        Switch to This
                    </button>
                </div>
            </div>
            </div>

            {{-- Multiple Location Plan --}}
            <div x-show="activeTab === 'multiple'" x-cloak>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; max-width: 680px; margin: 0 auto;">
                {{-- Monthly --}}
                <div style="border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 2rem; text-align: center;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; margin-bottom: 0.75rem;">Monthly Subscription</h4>
                    <p style="font-size: 2rem; font-weight: 700; color: #f59e0b;">$499.00</p>
                    <p style="font-size: 0.8rem; color: #f59e0b; margin-bottom: 1.5rem;">per month</p>
                    <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 1.25rem;">
                    <ul style="list-style: none; padding: 0; margin: 0; text-align: left;">
                        @foreach(['Unlimited Users', 'Unlimited Claims', 'Daily tracking of claims', 'Close Ratio', 'Average Days to Close', 'Average Supplement Dollar Increase'] as $feature)
                            <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #e2e8f0; padding: 0.25rem 0;">
                                <span style="color: #f59e0b; font-weight: 700;">&#10003;</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <p style="font-size: 0.75rem; color: #475569; margin-top: 1rem; font-style: italic;">16% savings (2 free months)</p>
                    <button style="margin-top: 1.25rem; width: 100%; padding: 0.65rem 1rem; background: #f59e0b; color: #1e293b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border: none; border-radius: 0.5rem; cursor: pointer;">
                        Switch to This
                    </button>
                </div>

                {{-- Yearly --}}
                <div style="border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 2rem; text-align: center;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #e2e8f0; margin-bottom: 0.75rem;">Yearly Subscription</h4>
                    <p style="font-size: 2rem; font-weight: 700; color: #f59e0b;">$4,999.00</p>
                    <p style="font-size: 0.8rem; color: #f59e0b; margin-bottom: 1.5rem;">per year</p>
                    <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 1.25rem;">
                    <ul style="list-style: none; padding: 0; margin: 0; text-align: left;">
                        @foreach(['Unlimited Users', 'Unlimited Claims', 'Daily tracking of claims', 'Close Ratio', 'Average Days to Close', 'Average Supplement Dollar Increase'] as $feature)
                            <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #e2e8f0; padding: 0.25rem 0;">
                                <span style="color: #f59e0b; font-weight: 700;">&#10003;</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                    <p style="display: flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; color: #f59e0b; margin-top: 1rem;">
                        <span style="font-weight: 700;">&#10003;</span>
                        16% savings (2 free months)
                    </p>
                    <button style="margin-top: 1.25rem; width: 100%; padding: 0.65rem 1rem; background: #f59e0b; color: #1e293b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border: none; border-radius: 0.5rem; cursor: pointer;">
                        Switch to This
                    </button>
                </div>
            </div>
            </div>

            {{-- Cancel subscription --}}
            <div style="text-align: right; margin-top: 1.5rem;">
                <button style="background: none; border: none; color: #f59e0b; font-size: 0.85rem; cursor: pointer; text-decoration: none;">
                    Cancel subscription
                </button>
            </div>
        </x-filament::section>

        {{-- Invoices --}}
        <x-filament::section style="margin-top: 1.5rem;">
            <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 1.5rem;">Invoices</h3>
            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 3rem 0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" style="width: 6rem; height: 6rem; margin-bottom: 1rem;">
                    <path d="M12 22h20l6-8h30a4 4 0 014 4v40a4 4 0 01-4 4H12a4 4 0 01-4-4V26a4 4 0 014-4z" fill="#d4a574" opacity="0.8"/>
                    <path d="M8 30h64v28a4 4 0 01-4 4H12a4 4 0 01-4-4V30z" fill="#e8c49a" opacity="0.9"/>
                    <rect x="20" y="16" width="16" height="6" rx="1" fill="#c49660" opacity="0.7"/>
                </svg>
                <p style="font-size: 0.875rem; color: #64748b;">Looks like there is still no data available to see</p>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
