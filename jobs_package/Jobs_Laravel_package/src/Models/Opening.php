<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opening extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'user_id',
        'category_id',
        'type',
        'salary_type',
        'salary_range',
        'currency',
        'experience',
        'expertise',
        'featured_expire_at',
        'live_expire_at',
        'attachment',
        'address',
        'fields',
        'status',
        'apply_type',
        'meta',
        'expired_at',
        'total_visits',
    ];

    protected $casts = [
        'featured_expire_at' => 'date',
        'live_expire_at' => 'date',
        'expired_at' => 'date',
        'fields' => 'array',
        'meta' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_opening');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_opening')
            ->where('type', 'job_tag');
    }

    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'location_opening', 'opening_id', 'country_id');
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(UserJob::class, 'opening_id');
    }
}
