<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SkillTag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
    ];

    public function openings(): BelongsToMany
    {
        return $this->belongsToMany(Opening::class, 'opening_skill_tag');
    }
}
