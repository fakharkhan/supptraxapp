<x-filament-panels::page>
    @if($this->organization)
        <div class="space-y-6">
            {{-- Date of registration --}}
            <x-filament::section>
                <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                    <div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0;">Date of registration</h3>
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #94a3b8;">
                            {{ $this->organization->date_of_registration?->format('M d, Y') ?? '—' }}
                        </p>
                    </div>
                    <div>
                        {{ $this->serviceAgreementAction }}
                    </div>
                </div>
            </x-filament::section>

            {{-- Organization details --}}
            <x-filament::section>
                <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 1rem;">Organization details</h3>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Organization name</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->name ?? '—' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Organization address</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->organization_address ?? '—' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Zip code</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->organization_zip ?? '—' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">State</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->organization_state ?? '—' }}</p>
                    </div>
                </div>
            </x-filament::section>

            {{-- Billing details --}}
            <x-filament::section>
                <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 1rem;">Billing details</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Billing address</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->billing_address ?? '—' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Zip code</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->billing_zip ?? '—' }}</p>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">State</p>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; font-weight: 500; color: #e2e8f0;">{{ $this->organization->billing_state ?? '—' }}</p>
                    </div>
                </div>
            </x-filament::section>

            {{-- Contact person --}}
            <x-filament::section>
                <h3 style="font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 1rem;">Contact person</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Full name</p>
                        <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                            <span style="flex: 1; font-size: 0.875rem; font-weight: 500; color: #e2e8f0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $this->organization->contact_full_name ?? '—' }}</span>
                            <button wire:click="mountAction('editContactFullName')" style="flex-shrink: 0; color: #f59e0b; cursor: pointer; background: none; border: none; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Phone number</p>
                        <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                            <span style="flex: 1; font-size: 0.875rem; font-weight: 500; color: #e2e8f0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $this->organization->contact_phone ?? '—' }}</span>
                            <button wire:click="mountAction('editContactPhone')" style="flex-shrink: 0; color: #f59e0b; cursor: pointer; background: none; border: none; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Email</p>
                        <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                            <span style="flex: 1; font-size: 0.875rem; font-weight: 500; color: #e2e8f0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $this->organization->contact_email ?? '—' }}</span>
                            <button wire:click="mountAction('editContactEmail')" style="flex-shrink: 0; color: #f59e0b; cursor: pointer; background: none; border: none; padding: 0;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </x-filament::section>
        </div>

        <x-filament-actions::modals />
    @else
        <x-filament::section>
            <p style="font-size: 0.875rem; color: #64748b;">No organization linked to your account.</p>
        </x-filament::section>
    @endif
</x-filament-panels::page>
