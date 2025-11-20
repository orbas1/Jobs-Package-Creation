<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'preview',
        'type',
        'status',
        'is_featured',
        'is_menu_item',
        'lang',
        'category_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function openings(): BelongsToMany
    {
        return $this->belongsToMany(Opening::class, 'category_opening');
    }
}
