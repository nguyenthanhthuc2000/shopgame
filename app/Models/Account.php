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

    protected $appends = ['price_atm', 'class_name', 'earring_name', 'regis_type_name'];

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

    const CLASSED = [
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
        return collect(self::CLASSED)->where('value', $this->class)->first()['name'];
    }

    public function getEarringNameAttribute()
    {
        return collect(self::EARRING)->where('value', $this->earring)->first()['name'];
    }

    public function getRegisTypeNameAttribute()
    {
        return collect(self::REGIS_TYPE)->where('value', $this->earring)->first()['name'];
    }

    public function banner()
    {
        return $this->hasOne(Image::class)->where('is_banner', true);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
