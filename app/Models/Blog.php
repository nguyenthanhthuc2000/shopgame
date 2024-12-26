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
        ],
        [
            'name' => 'Hiện',
            'value' => 1,
            'is_default' => true,
        ],
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeFilterByTitle($query, $title)
    {
        $query->where('title', 'LIKE', "%{$title}%");
    }

    public function getStatusNameAttribute()
    {
        $status = collect(self::STATUS)->firstWhere('value', $this->status);
        return $status ? $status['name'] : null;
    }
    //     public function canEdit(): bool
    // {
    //     // Chỉ người dùng sở hữu bài viết mới có thể chỉnh sửa/xóa
    //     return $this->user_id === Auth::id();
    // }
}
