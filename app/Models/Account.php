<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Account extends Model
{
    use SoftDeletes;

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

    protected $appends = ['price_atm', 'class_name', 'earring_name', 'regis_type_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    const STATUS_AVAILABLE = 1;
    const STATUS_HIDE = 0;
    const STATUS_SOLD = 2;

    const CLASSES = [
        [
            'name' => 'Xayda',
            'value' => '1',
        ],
        [
            'name' => 'Trái đất',
            'value' => '2',
        ],
        [
            'name' => 'Namec',
            'value' => '3',
        ],
    ];

    const REGIS_TYPE = [
        [
            'name' => 'Ảo',
            'value' => '0',
        ],
        [
            'name' => 'Email',
            'value' => '1',
        ],
    ];

    const EARRING = [
        [
            'name' => 'Có',
            'value' => '1',
        ],
        [
            'name' => 'Không',
            'value' => '0',
        ],
    ];

    const SERVER = [
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
    ];

    const STATUS = [
        [
            'name' => 'Ẩn',
            'value' => 0
        ],
        [
            'name' => 'Đang bán',
            'value' => 1
        ],
        [
            'name' => 'Đã bán',
            'value' => 2
        ],
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get banner of the account
     * @param string $size
     * @param string $column
     * @return string
     */
    public function getBannerLink($size = '1000', $column = 'image_link')
    {
        $link = $this->banner->select($column)->first()->$column ?? '';

        if (!$link) {
            return '';
        }

        if ($size) {
            return "$link&sw=$size";
        }

        return $link;
    }

    /**
     * Get banner of the account
     * @param string $size
     * @param string $column
     * @return array|Collection
     */
    public function getGalleryLinks($size = '1000', $column = 'image_link'): array|Collection
    {
        $gallery = $this->gallery->select($column);

        if (empty($gallery)) {
            return [];
        }

        $list = [];
        foreach ($gallery as $item) {
            $list[] = $item[$column] . ($size ? "&sw=$size" : '');
        }

        return $list;
    }
    public function scopeByCode($query, $code)
    {
        return $query->where('id', $code);
    }
    public function scopeByPrice($query, $price)
    {
        $priceRange = explode(' ', $price);
        return $query->whereBetween('price', $priceRange);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByServer($query, $server)
    {
        return $query->where('server', $server);
    }

    public function scopeByClass($query, $class)
    {
        return $query->where('class', $class);
    }
}
