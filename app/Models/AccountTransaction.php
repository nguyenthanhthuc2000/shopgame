<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_transactions';

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

    const ORDER_SUCCESS = 1;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function scopeFilterByUuid($query, $uuid)
    {
        if (!empty($uuid)) {
            $query->where('uuid', 'like', '%' . $uuid . '%');
        }
    }
}
