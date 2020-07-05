<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectBoard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'abbreviation',
        'owner_id'
    ];

    // Relationships
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
