<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'description',
        'order',
        'points',
        'video_url',
        'badge_icon',
        'badge_name',
        'submission_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function submissions()
    {
        return $this->hasMany(MissionSubmission::class);
    }
}
