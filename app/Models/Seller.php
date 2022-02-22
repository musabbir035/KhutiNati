<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Seller
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $address
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Database\Factories\SellerFactory factory(...$parameters)
 * @mixin \Eloquent
 */
class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'mobile',
        'email',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageFileAttribute()
    {
        if (!is_null($this->image) && Storage::disk('public')->exists('images/sellers/' . $this->image)) {
            return 'storage/images/sellers/' . $this->image;
        }
        return 'img/no-image.png';
    }
}
