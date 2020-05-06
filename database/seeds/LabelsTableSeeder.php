<?php

use Illuminate\Database\Seeder;
use App\Label;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Label::create([
            'title' => 'Lowest',
            'description' => 'Little or no impact on progress',
            'color' => '#61bd4f',            
            'icon' => 'fa fa-angle-double-down',
            'priority' => 1,
        ]);

        Label::create([
            'title' => 'Low',
            'description' => 'Minor problem or easily worked around',
            'color' => '#d9b51c',            
            'icon' => 'fa fa-angle-down',
            'priority' => 2,
        ]);

        Label::create([
            'title' => 'Medium',
            'description' => 'Has the potential to block process',
            'color' => '#cd8313',            
            'icon' => 'fa fa-equals',
            'priority' => 3,
        ]);

        Label::create([
            'title' => 'High',
            'description' => 'Serious problem that could block process',
            'color' => '#b04632',            
            'icon' => 'fa fa-angle-up',
            'priority' => 4,
        ]);

        Label::create([
            'title' => 'Highest',
            'description' => 'This problem will block process',
            'color' => '#89609e',            
            'icon' => 'fa fa-angle-down',
            'priority' => 5,
        ]);
    }
}
