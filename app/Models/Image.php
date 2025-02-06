<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Image extends Model
{
    use SoftDeletes;

    public const IS_BANNER = 1;

    public const IS_IMAGE_DETAIL = 0;

    public const IMAGE_SIZE = 1000;

    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function getFullImageLinkAttribute()
    {
        return $this->image_link . "&sw=" . self::IMAGE_SIZE;
    }

    public function scopeIsBanner($query)
    {
        return $query->whereIsBanner(self::IS_BANNER);
    }
}
