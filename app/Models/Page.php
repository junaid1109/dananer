<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $casts = [
        'seo_content' => 'object'
    ];

    public function scopeActiveTemplate($query)
    {
        return $query->where('tempname', activeTemplate());
    }
}
