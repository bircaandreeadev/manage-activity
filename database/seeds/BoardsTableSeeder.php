<?php

use Illuminate\Database\Seeder;
use App\Board;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::create([
            'title' => 'Frontend',
            'project_id' => 1
        ]);
        Board::create([
            'title' => 'Backend',
            'project_id' => 1
        ]);
        Board::create([
            'title' => 'Done',
            'project_id' => 1
        ]);
        Board::create([
            'title' => 'To do',
            'project_id' => 2
        ]);
        Board::create([
            'title' => 'In Progress',
            'project_id' => 2
        ]);
        Board::create([
            'title' => 'Bugs',
            'project_id' => 2
        ]);
        Board::create([
            'title' => 'Done',
            'project_id' => 2
        ]);
    }
}
