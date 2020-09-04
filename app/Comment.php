<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'comment_parent_id');
    }
}
