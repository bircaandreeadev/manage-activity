<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'title' => 'CRM Gym Fitness',
            'description' => 'Manage the entire sales process from cold lead to active customer with a CRM built and customized for fitness industry sales professionals.',
            'tag' => 'CRMGFIT',
        ]);

        Project::create([
            'title' => 'ERP Hotel Pennsylvania',
            'description' => 'A comprehensive Hotel Management System that takes care of all functional aspects of all types of hotels and Restaurant.',
            'tag' => 'ERPHP',
        ]);

        DB::table('project_user')->insert([
            [
                'user_id' => 1,
                'project_id' => 1
            ],
            [
                'user_id' => 2,
                'project_id' => 1
            ],
            [
                'user_id' => 4,
                'project_id' => 1
            ],
            [
                'user_id' => 7,
                'project_id' => 1
            ],
            [
                'user_id' => 1,
                'project_id' => 2
            ],
            [
                'user_id' => 2,
                'project_id' => 2
            ],
            [
                'user_id' => 3,
                'project_id' => 2
            ],
            [
                'user_id' => 5,
                'project_id' => 2
            ],
            [
                'user_id' => 6,
                'project_id' => 2
            ],
        ]);
    }
}
