<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CouponCode
 *
 * @property int $id
 * @property string $code
 * @property int $discount_percentage
 * @property int $maximum_discount
 * @property \Illuminate\Support\Carbon $validity_start
 * @property \Illuminate\Support\Carbon $validity_end
 * @method static \Illuminate\Database\Eloquent\Builder|CouponCode query()
 * @mixin \Eloquent
 */
class CouponCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'validity_start',
        'validity_end',
        'discount_percentage',
        'maximum_discount'
    ];
}
