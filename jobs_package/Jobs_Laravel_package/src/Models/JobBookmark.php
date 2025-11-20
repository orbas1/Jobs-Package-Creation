<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobBookmark extends Model
{
    public $timestamps = false;

    protected $table = 'jobbookmarks';

    protected $fillable = [
        'user_id',
        'opening_id',
    ];

    public function opening(): BelongsTo
    {
        return $this->belongsTo(Opening::class, 'opening_id');
    }

    public function user(): BelongsTo
    {
        $model = config('jobs.user_model');

        return $this->belongsTo($model, 'user_id');
    }
}
