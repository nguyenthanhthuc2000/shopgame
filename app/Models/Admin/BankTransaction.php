<?php

namespace App\Models\Admin;
 
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_transactions';

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

    const INCREASE_TYPE = 1; // Cộng tiền
    const DECREASE_TYPE = 0; // Trừ tiền
}