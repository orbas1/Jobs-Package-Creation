<?php

namespace JobsLaravelPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'title',
        'gpa',
    ];
}
