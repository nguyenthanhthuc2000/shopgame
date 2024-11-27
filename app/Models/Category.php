<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Category extends Model
{

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

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'category_id');
    }

    public function soldAccounts()
    {
        return $this->hasMany(Account::class, 'category_id')->where('status', 1);
    }

    public function unsoldAccounts()
    {
        return $this->hasMany(Account::class, 'category_id')->where('status', 2);
    }
}
