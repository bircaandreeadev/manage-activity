<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'title' => 'Design database',
            'due_date' => '2020-06-01',
            'label_id' => 1,
            'user_id' => 2,
            'board_id' => 2,
        ]);
        Task::create([
            'title' => 'Models and relationships',
            'due_date' => '2020-06-02',
            'label_id' => 1,
            'user_id' => 2,
            'board_id' => 2,
        ]);
        Task::create([
            'title' => 'Welcome page',
            'due_date' => '2020-06-01',
            'label_id' => 2,
            'user_id' => 4,
            'board_id' => 1,
        ]);
        Task::create([
            'title' => 'Design database',
            'due_date' => '2020-06-01',
            'label_id' => 1,
            'user_id' => 2,
            'board_id' => 4,
        ]);
        Task::create([
            'title' => 'Setup server',
            'due_date' => '2020-06-02',
            'label_id' => 1,
            'user_id' => 3,
            'board_id' => 4,
        ]);
        Task::create([
            'title' => 'Welcome page',
            'due_date' => '2020-06-01',
            'label_id' => 2,
            'user_id' => 5,
            'board_id' => 4,
        ]);
    }
}
