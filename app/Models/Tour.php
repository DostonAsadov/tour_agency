<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'tours';

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'capacity_of_people',
        'season',
        'image',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'capacity_of_people' => 'integer',
    ];

    // Relation to categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_tour');
    }
}
