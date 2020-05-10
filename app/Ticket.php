<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'description',
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
            ->orderBy('id', 'asc');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'In Progress')
            ->orderBy('id', 'asc');
    }

    public function scopeQualityAssurance($query)
    {
        return $query->where('status', 'QA')
            ->orderBy('id', 'asc');
    }

    public function scopeInReview($query)
    {
        return $query->where('status', 'In Review')
            ->orderBy('id', 'asc');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'Closed')
            ->orderBy('id', 'asc');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'Rejected')
            ->orderBy('id', 'asc');
    }
}
