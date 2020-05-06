<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
