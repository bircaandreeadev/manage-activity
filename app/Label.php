<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'color', 'icon'
    ];

    /**
     * Get the tasks for the label.
     */
    public function tasks() {
        return $this->hasMany('App\Task');
    }
}
