<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\ClaimComment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClaimCommentSeeder extends Seeder
{
    public function run(): void
    {
        $board15 = Board::where('board_id', 15)->first();
        $board18 = Board::where('board_id', 18)->first();

        if (! $board15 || ! $board18) {
            return;
        }

        $comments = [
            ['board_id' => $board15->id, 'page' => null, 'index' => 1, 'author' => 'Unknown', 'text' => 'Just checked Acculynx and there is no update and no revised yet.', 'commented_at' => null],
            ['board_id' => $board15->id, 'page' => null, 'index' => 2, 'author' => 'Unknown', 'text' => 'I tagged Bethany and the sales person on this one and explained again what the reason was.', 'commented_at' => null],
            ['board_id' => $board15->id, 'page' => null, 'index' => 3, 'author' => 'Unknown', 'text' => 'Not following up on this one as I cannot receive the revised.', 'commented_at' => null],
            ['board_id' => $board15->id, 'page' => null, 'index' => 4, 'author' => 'David Hughes', 'text' => 'took a look at both estimates today and noted that our supplement is higher than the original.', 'commented_at' => Carbon::parse('2026-03-01 18:43')],
            ['board_id' => $board15->id, 'page' => null, 'index' => 5, 'author' => 'David Hughes', 'text' => 'called and left messages for the adjuster, the supervisor and the HO', 'commented_at' => Carbon::parse('2026-02-23 13:14')],
            ['board_id' => $board18->id, 'page' => 1, 'index' => 1, 'author' => 'Sarah McGarvey', 'text' => 'Closing to CBC as no one at Ruffin can get the revised and adjuster refuses to send us anything.', 'commented_at' => Carbon::parse('2025-10-06 10:43')],
            ['board_id' => $board18->id, 'page' => 1, 'index' => 2, 'author' => 'Sarah McGarvey', 'text' => 'Checked the file. Brittany said we likely will not be getting the RCV nor the revised.', 'commented_at' => Carbon::parse('2025-07-31 16:32')],
            ['board_id' => $board18->id, 'page' => 1, 'index' => 3, 'author' => 'Sarah McGarvey', 'text' => 'No revised uploaded. Tagged Brittany and asked for the RCV of supplement.', 'commented_at' => Carbon::parse('2025-07-23 10:58')],
            ['board_id' => $board18->id, 'page' => 1, 'index' => 4, 'author' => 'Sarah McGarvey', 'text' => 'Brittany said per LaMar there won\'t be a revised obtained.', 'commented_at' => Carbon::parse('2025-07-16 13:26')],
            ['board_id' => $board18->id, 'page' => 1, 'index' => 5, 'author' => 'Sarah McGarvey', 'text' => 'Tagged Caleb, Brittany, and Drew in Proline to get the final from the homeowner.', 'commented_at' => Carbon::parse('2025-07-09 11:10')],
        ];

        foreach ($comments as $comment) {
            ClaimComment::updateOrCreate(
                [
                    'board_id' => $comment['board_id'],
                    'page' => $comment['page'],
                    'index' => $comment['index'],
                ],
                $comment,
            );
        }
    }
}
