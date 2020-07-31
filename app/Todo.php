<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject',
    ];

    // Relationships
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function items()
    {
        return $this->hasMany('App\TodoItem');
    }
}
