<?php

namespace App\Models\Admin;
 
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CardTransaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'card_transactions';

    protected $primaryKey = 'id';
    protected $perPage = 15;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
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
    
    public function user()
    {
        return $this->hasOne(User::class);
    }
}