<div style="max-height: 400px; overflow-y: auto;">
    @forelse($claim->notes as $note)
        <div style="padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <p style="font-weight: 600; color: #e2e8f0; font-size: 0.875rem;">{{ $note->author }}</p>
            <p style="color: #cbd5e1; font-size: 0.85rem; margin-top: 0.5rem; white-space: pre-wrap;">{{ $note->text }}</p>
            <p style="color: #64748b; font-size: 0.75rem; margin-top: 0.5rem;">
                {{ $note->commented_at?->format('M d, Y') }} &bull; {{ $note->commented_at?->format('H:i') }}
            </p>
        </div>
    @empty
        <div style="text-align: center; padding: 2rem 0;">
            <p style="color: #64748b; font-size: 0.875rem;">No comments yet.</p>
        </div>
    @endforelse
</div>
