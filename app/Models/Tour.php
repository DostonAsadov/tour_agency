<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'season'
    ];
}
