<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserJob extends Model
{
    protected $table = 'userjobs';

    protected $fillable = [
        'user_id',
        'opening_id',
        'stage_id',
        'status',
        'seen_at',
        'is_hired',
        'meta',
    ];

    protected $casts = [
        'seen_at' => 'datetime',
        'is_hired' => 'boolean',
        'meta' => 'array',
    ];

    public function opening(): BelongsTo
    {
        return $this->belongsTo(Opening::class, 'opening_id');
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(AtsStage::class, 'stage_id');
    }

    public function user(): BelongsTo
    {
        $model = config('jobs.user_model');

        return $this->belongsTo($model, 'user_id');
    }
}
