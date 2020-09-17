<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectBoard extends Model
{
    use SoftDeletes;
    use HasFactory;

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
