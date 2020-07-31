<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
    ];

    // Relationships
    public function todo()
    {
        return $this->belongsTo('App\Todo');
    }
}
