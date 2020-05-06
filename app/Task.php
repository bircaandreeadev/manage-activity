<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'due_date', 'completed', 'label_id', 'user_id', 'board_id'
    ];

    /**
     * Get the board of the task.
     */
    public function board() {
        return $this->belongsTo('App\Board');
    }

    /**
     * Get the user of the task.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the label of the task.
     */
    public function label() {
        return $this->belongsTo('App\Label');
    }
}
