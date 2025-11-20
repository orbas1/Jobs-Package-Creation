<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'meta',
        'location_id',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Location::class, 'location_id');
    }

    public function openings(): BelongsToMany
    {
        return $this->belongsToMany(Opening::class, 'location_opening', 'country_id', 'opening_id');
    }
}
