<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $mobile
 * @property string|null $mobile_verified_at
 * @property string $password
 * @property int $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User find()
 * @method static \Illuminate\Database\Eloquent\Builder|User findOrFail()
 * @method withFilters()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPushSubscriptions;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'role'
    ];

    //roles
    public static $SUPERADMIN = 1;
    public static $ADMIN = 2;
    public static $CUSTOMER = 3;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notificationChecks()
    {
        return $this->hasMany(NotificationCheck::class);
    }

    public function scopeWithFilters($query, $searchQuery, $role)
    {
        return $query->withTrashed()->when($searchQuery, function ($q) use ($searchQuery) {
            return $q->where('name', 'like', '%' . $searchQuery . '%');
        })->when($role, function ($q) use ($role) {
            return $q->where('role', $role);
        });
    }
}
