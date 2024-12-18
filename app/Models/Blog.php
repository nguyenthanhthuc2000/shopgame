<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $perPage = 10;

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
