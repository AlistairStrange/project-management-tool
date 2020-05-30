<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectBoard extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // Relationships
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
