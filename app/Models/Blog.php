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

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function scopeFilterById($query, $id)
    {
        if (!empty($id)) {
            $query->where('id', $id);
        }
        return $query;
    }

    //     public function canEdit(): bool
    // {
    //     // Chỉ người dùng sở hữu bài viết mới có thể chỉnh sửa/xóa
    //     return $this->user_id === Auth::id();
    // }
}
