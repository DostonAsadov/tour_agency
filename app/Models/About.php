<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    //

    public $timestamps = false;
    protected $fillable = [
        'company_name',
        'email',
        'phone',
        'phone2',
        'working_hours',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'travelers',
        'hotels',
        'completed_tours',
        'experience_years',
        'number_partners',
        'address',
    ];

    protected $casts = [
        'working_hours' => 'array',

    ];
}
