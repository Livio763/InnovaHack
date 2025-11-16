<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'description',
        'order',
        'icon',
        'max_days',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class)->orderBy('order');
    }
}
