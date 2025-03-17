<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class CardTransaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'card_transactions';

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

    public const CARD_TYPES = [
        'VIETTEL' => 'Viettel',
        'VCOIN' => 'VCOIN',
        'ZING' => 'ZING',
        'GATE' => 'GATE',
        'GARENA' => 'GARENA',
        'SCOIN' => 'SCOIN',
        'VINAPHONE' => 'Vinaphone',
        // 'MOBIFONE' => 'Mobifone',
    ];
    public const IS_SUCCESS_TRANSACTION = 1;
    public const IS_ERROR_TRANSACTION = 2;
    public const IS_PROCESSING_TRANSACTION = 0;

    public const IS_SUCCESSFUL_CARD = 1;
    public const IS_SUCCESSFUL_CARD_WRONG_DENOMINATION = 2;
    public const IS_ERROR_CARD = 3;
    public const IS_MAINTENANCE_CARD = 4;
    public const IS_PENDING_CARD = 99;
    
    public const CARD_STATUS = [
        self::IS_SUCCESSFUL_CARD => 'Thẻ thành công',
        self::IS_SUCCESSFUL_CARD_WRONG_DENOMINATION => 'Thẻ thành công sai mệnh giá',
        self::IS_ERROR_CARD => 'Thẻ lỗi',
        self::IS_MAINTENANCE_CARD => 'Hệ thống bảo trì',
        self::IS_PENDING_CARD => 'Thẻ chờ xử lý',
    ];

    public const TRANSACTION_STATUS = [
        self::IS_PROCESSING_TRANSACTION => 'Đang xử lý',
        self::IS_SUCCESS_TRANSACTION => 'Thành công',
        self::IS_ERROR_TRANSACTION => 'Thất bại',
    ];

    public const HISTORY_PERPAGE = 15;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function scopeFilterBySerial($query, $serial)
    {
        if (!empty($serial)) {
            $query->where('serial', 'like', "%{$serial}%");
        }
    }
}
