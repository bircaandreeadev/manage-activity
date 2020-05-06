<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
