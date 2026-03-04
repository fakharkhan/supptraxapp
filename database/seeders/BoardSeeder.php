<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    public function run(): void
    {
        $boards = [
            ['board_id' => 15, 'name' => 'Board 15'],
            ['board_id' => 18, 'name' => 'Board 18'],
            ['board_id' => 19, 'name' => 'Board 19'],
            ['board_id' => 54, 'name' => 'Board 54'],
            ['board_id' => 59, 'name' => 'Board 59'],
            ['board_id' => 60, 'name' => 'Board 60'],
        ];

        foreach ($boards as $board) {
            Board::updateOrCreate(['board_id' => $board['board_id']], $board);
        }
    }
}
