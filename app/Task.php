<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Validate inputs
     */
    public static function validate(array $input)
    {
        $validator = Validator::make($input, [
            'title' => 'required',
            'due_date' => 'required|date',
            'completed' => 'date',
            'label_id' => 'required|exists:labels,id', 
            'user_id' => 'required|exists:users,id',
            'board_id' => 'required|exists:boards,id',
        ]);

        return $validator;
    }
}
