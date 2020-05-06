<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Board extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'project_id'
    ];

    /**
     * Get the project of the board.
     */
    public function project() {
        return $this->belongsTo('App\Project');
    }

    /**
     * Get the tasks for the board.
     */
    public function tasks() {
        return $this->hasMany('App\Task');
    }

    /**
     * Validate inputs
     */
    public static function validate(array $input)
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        return $validator;
    }
}
