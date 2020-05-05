<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'contact',
        'deadline',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
