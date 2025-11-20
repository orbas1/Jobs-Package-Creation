<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'preview',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        $model = config('jobs.user_model');

        return $this->belongsTo($model, 'user_id');
    }
}
