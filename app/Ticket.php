<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    protected $fillable = [
        'subject',
        'description',
        'priority',
        'reporter',
        'assignee_id',
        'contact',
        'deadline',
        'status',
        'story_points',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User', 'assignee_id');
    }

    public function projectBoard()
    {
        return $this->belongsTo('App\ProjectBoard');
    }

    public function todos()
    {
        return $this->hasMany('App\Todo');
    }


    /**
     * Local Scope functions for retrieving tickets based on status
     * Possible Options:
     * Open, InProgress, QualityAssurance, InReview, Closed, Rejected
     *
     * @param [ticket] $query
     * @return query builder 
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'Open')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'In Progress')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }

    public function scopeQualityAssurance($query)
    {
        return $query->where('status', 'QA')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }

    public function scopeInReview($query)
    {
        return $query->where('status', 'In Review')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'Closed')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'Rejected')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc');
    }
}
