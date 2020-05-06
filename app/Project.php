<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'tag', 'description'
    ];

    /**
     * Get the boards for the project.
     */
    public function boards() {
        return $this->hasMany('App\Board');
    }

    /**
     * Get the users for the project.
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the lead of the project.
     */
    public function lead() {
        return $this->users()->wherePivot('lead', 1)->first();
    }

    /**
     * Get the members of the project.
     */
    public function members() {
        return $this->users()->wherePivot('lead', '<>', 1)->get();
    }

    /**
     * Get the number of tasks of the project.
     */
    public function numberOfTasks() {
        $count = 0;
        foreach($this->boards as $board) {
            $count += $board->tasks->count();
        }
        return $count;
    }

    /**
     * Validate inputs
     */
    public static function validate(array $input)
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'tag' => 'required',
            'description' => '',
            'lead' => 'required|exists:users,id'
        ]);

        return $validator;
    }
}
