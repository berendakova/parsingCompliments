<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compliment extends Model
{
    use HasFactory;

    public $name;

    protected $fillable = [
        'text',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Category', 'compliments_categories_pivot', 'compliment_id', 'category_id');
    }
}
