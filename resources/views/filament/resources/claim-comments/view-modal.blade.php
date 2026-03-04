<div class="space-y-4">
    <div>
        <span class="font-semibold">{{ $record->author ?? 'Unknown' }}</span>
        @if($record->commented_at)
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ $record->commented_at->format('M j, Y g:i A') }}
            </span>
        @endif
    </div>
    <div class="whitespace-pre-wrap rounded-lg bg-gray-50 dark:bg-gray-800 p-4 text-sm">
        {{ $record->text }}
    </div>
    <div class="text-xs text-gray-500 dark:text-gray-400">
        Board {{ $record->board->board_id ?? '—' }}
        @if($record->page) · Page {{ $record->page }} @endif
        · Index {{ $record->index }}
    </div>
</div>
