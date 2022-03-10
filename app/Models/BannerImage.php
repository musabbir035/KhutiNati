<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\BannerImage
 *
 * @property int $id
 * @property string $image
 * @property string $url
 * @property string $title
 * @property string $subtext
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class BannerImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'url',
        'title',
        'subtext',
        'type',
        'status'
    ];

    // types
    public static $BANNER = 1;
    public static $SLIDER = 2;

    // status
    public static $ACTIVE = 1;
    public static $DISABLED = 2;
}
