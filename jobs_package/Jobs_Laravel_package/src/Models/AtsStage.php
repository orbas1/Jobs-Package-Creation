<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AtsStage extends Model
{
    protected $fillable = [
        'opening_id',
        'name',
        'slug',
        'position',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function opening(): BelongsTo
    {
        return $this->belongsTo(Opening::class, 'opening_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(UserJob::class, 'stage_id');
    }

    public function scopeForOpening($query, ?Opening $opening)
    {
        return $query
            ->where(function ($builder) use ($opening) {
                $builder->whereNull('opening_id');

                if ($opening) {
                    $builder->orWhere('opening_id', $opening->getKey());
                }
            })
            ->orderBy('position');
    }

    public static function defaultStage(): ?self
    {
        return static::query()
            ->where('is_default', true)
            ->orderBy('position')
            ->first();
    }
}
