<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
    ];

    public function compliments(): BelongsToMany
    {
        return $this->belongsToMany('App\Compliment', 'compliments_categories_pivot');
    }
}
