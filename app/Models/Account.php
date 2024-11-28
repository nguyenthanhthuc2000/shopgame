<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;

class Account extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts';

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
    protected $casts = [
    ];

    const STATUS_AVAILABLE = 1;
    const STATUS_HIDE = 0;
    const STATUS_SOLD = 2;

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
