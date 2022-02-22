<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $unit
 * @property int $price
 * @property int|null $discounted_price
 * @property string|null $image
 * @property int|null $is_featured
 * @property int $category_id
 * @property int|null $seller_id
 * @property int $inventory
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orderPorduct
 * @property-read \App\Models\Seller|null $seller
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @mixin \Eloquent
 * @method withFilters()
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'discounted_price',
        'image',
        'is_featured',
        'category_id',
        'seller_id',
        'inventory',
        'slug'
    ];

    public static $ISFEATURED = 1;
    public static $ISNOTFEATURED = 2;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function orderPorduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getImageFileAttribute()
    {
        if (!is_null($this->image) && Storage::disk('public')->exists('images/products/' . $this->image)) {
            return 'storage/images/products/' . $this->image;
        }
        return 'img/no-image.png';
    }

    public function scopeWithFilters(
        $query,
        $categoryId = null,
        $searchQuery = null,
        $sellerId = null,
        $isOnSale = null,
        $isFeatured = null
    ) {
        //return $isFeatured;
        return $query->when($searchQuery, function ($q) use ($searchQuery) {
            return $q->where('name', 'like', '%' . $searchQuery . '%');
        })->when($categoryId, function ($q) use ($categoryId) {
            return $q->where('category_id', $categoryId);
        })->when($sellerId, function ($q) use ($sellerId) {
            return $q->where('seller_id', $sellerId);
        })->when($isOnSale, function ($q) {
            return $q->whereNotNull('discounted_price');
        })->when($isFeatured, function ($q) {
            return $q->where('is_featured', 1);
        })->orderBy('id', 'desc');
    }
}
