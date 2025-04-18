<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use LaravelWakeUp\FilterSort\Traits\FilterTrait;
use LaravelWakeUp\FilterSort\Traits\SortTrait;
use App\Models\Admin\Category;

class Account extends Model
{
    use SoftDeletes;
    use FilterTrait, SortTrait;

    protected array $allowedFilters = ['id', 'server', 'class', 'earring', 'price', 'status'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    protected $primaryKey = 'id';

    protected $hidden = ['password'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $perPage = 12;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $appends = ['price_atm', 'class_name', 'earring_name', 'regis_type_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public const STATUS_AVAILABLE = 1;
    public const STATUS_HIDE = 0;
    public const STATUS_SOLD = 2;

    public const CLASSES = [
        [
            'name' => 'Xayda',
            'value' => '1',
        ],
        [
            'name' => 'Trái đất',
            'value' => '2',
        ],
        [
            'name' => 'Namek',
            'value' => '3',
        ],
    ];

    public const REGIS_TYPE = [
        [
            'name' => 'Ảo',
            'value' => '0',
        ],
        [
            'name' => 'Email',
            'value' => '1',
        ],
    ];

    public const EARRING = [
        [
            'name' => 'Có',
            'value' => '1',
        ],
        [
            'name' => 'Không',
            'value' => '0',
        ],
    ];

    public const SERVER = [
        [
            'name' => 'Server 1',
            'value' => '1',
        ],
        [
            'name' => 'Server 2',
            'value' => '2',
        ],
        [
            'name' => 'Server 3',
            'value' => '3',
        ],
        [
            'name' => 'Server 4',
            'value' => '4',
        ],
        [
            'name' => 'Server 5',
            'value' => '5',
        ],
        [
            'name' => 'Server 6',
            'value' => '6',
        ],
        [
            'name' => 'Server 7',
            'value' => '7',
        ],
        [
            'name' => 'Server 8',
            'value' => '8',
        ],
        [
            'name' => 'Server 9',
            'value' => '9',
        ],
        [
            'name' => 'Server 10',
            'value' => '10',
        ],
        [
            'name' => 'Server 11',
            'value' => '11',
        ],
        [
            'name' => 'Server 12',
            'value' => '12',
        ],
        [
            'name' => 'Server 13',
            'value' => '13',
        ],
    ];

    public const STATUS = [
        [
            'name' => 'Ẩn',
            'value' => self::STATUS_HIDE,
            'bg_color' => 'hide',
            'is_default' => false,
        ],
        [
            'name' => 'Đang bán',
            'value' => self::STATUS_AVAILABLE,
            'bg_color' => 'avaiable',
            'is_default' => true,
        ],
        [
            'name' => 'Đã bán',
            'value' => self::STATUS_SOLD,
            'bg_color' => 'sold',
            'is_default' => false,
        ],
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the status name.
     */
    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn() => collect(self::STATUS)->where('value', $this->status)->first()['name'],
        );
    }

    /**
     * Get the status background color.
     */
    protected function statusBgColor(): Attribute
    {
        return Attribute::make(
            get: fn() => collect(self::STATUS)->where('value', $this->status)->first()['bg_color'],
        );
    }

    /**
     * Get the price formated.
     */
    protected function priceFormated(): Attribute
    {
        return Attribute::make(
            get: function() {
                if ($this->price === 0) {
                    return 0;
                }

                return number_format($this->price, 0, ',', '.');
            },
        );
    }

    public function getPriceAtmAttribute()
    {
        return ceil($this->price * 0.8 / 1000) * 1000;
    }

    public function getClassNameAttribute()
    {
        return collect(self::CLASSES)->where('value', $this->class)->first()['name'];
    }

    public function getEarringNameAttribute()
    {
        return collect(self::EARRING)->where('value', $this->earring)->first()['name'];
    }

    public function getRegisTypeNameAttribute()
    {
        return collect(self::REGIS_TYPE)->where('value', $this->regis_type)->first()['name'];
    }

    public function banner()
    {
        return $this->hasOne(Image::class)->where('is_banner', true);
    }

    public function gallery()
    {
        return $this->hasMany(Image::class)->where('is_banner', false);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get banner of the account
     * @param string $collumn
     * @return mixed
     */
    public function getBannerLink($collumn = ''): mixed
    {
        if ($collumn) {
            return $this->banner->$collumn;
        }

        return $this->banner;
    }

    /**
     * Get banner of the account
     * @return array|Collection
     */
    public function getGalleryLinks(): array|Collection
    {
        return $this->gallery;
    }

    /**
     * Check record can be edited
     */
    public function canEdit(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * Check record can be deleted
     */
    public function canDelete(): bool
    {
        return $this->author->id === Auth::id() && $this->status === self::STATUS_AVAILABLE;
    }

    public function hasGallery(): bool
    {
        return $this->gallery?->count() > 0;
    }

    public function hasBanner(): bool
    {
        return $this->banner?->count() > 0;
    }

    public function scopeIsAvailable($query)
    {
        $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopeByUserName($query, $username)
    {
        if (!empty($username)) {
            $query->where('username', 'like', "%$username%");
        }
    }
}
