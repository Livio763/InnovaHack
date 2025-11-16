<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'mission_id',
        'type',
        'content',
        'file_path',
        'status',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
