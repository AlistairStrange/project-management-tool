<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subject',
        'description',
        'priority',
        'reporter_id',
        'assignee',
        'contact',
        'deadline',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo('App\User', 'reporter_id');
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
