<?php

namespace App\Models;

use Google\Service\ServiceControl\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $perPage = 10;

    protected $table = 'blogs';

    protected $fillable = ['title', 'descriptions', 'slug', 'status', 'image', 'content'];

    const STATUS_AVAILABLE = 1;
    const STATUS_HIDE = 0;

    const STATUS = [
        [
            'name' => 'Ẩn',
            'value' => 0,
            'is_default' => false,
            'color' => 'text-light',
            'background' => 'bg-secondary'
        ],
        [
            'name' => 'Hiện',
            'value' => 1,
            'is_default' => true,
            'color' => 'text-light',
            'background' => 'bg-success'
        ],
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeFilterByKey($query, $filters)
    {
        $query->when(!empty($filters['username']), function ($query) use ($filters) {
            $query->whereHas('user', function ($query) use ($filters) {
                $query->where('name', 'LIKE', "%{$filters['username']}%");
            });
        });
    }

    public function getStatusNameAttribute()
    {
        $status = collect(self::STATUS)->firstWhere('value', $this->status);
        return $status ? $status['name'] : null;
    }

    public function getStatusColorAttribute()
    {
        $status = collect(self::STATUS)->firstWhere('value', $this->status);
        return $status ? $status['color'] . ' ' . $status['background'] : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
