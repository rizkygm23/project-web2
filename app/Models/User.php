<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }
    public function subscriptions()
{
    return $this->hasOne(Subscription::class);
}

    public function isSubscribed()
    {
        return $this->subscription &&
            $this->subscription->expires_at &&
            now()->lessThan($this->subscription->expires_at);
    }

    public function isPremium()
    {
        return optional($this->subscription)
            ->expires_at?->isFuture() ?? false;
    }

    public function isPremiums()
{
    return $this->subscription &&
           $this->subscription->expires_at &&
           $this->subscription->expires_at->isFuture();
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_premium',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
