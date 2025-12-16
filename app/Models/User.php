<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'google_id',
        'phone',
        'addres',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== RELASI NYA!!

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function Wishlists()
    {
        return $this->hasMany(wishlist::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function WishlistProduct()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
                    ->withTimestamp();
    }

// ======= HELPER METHOD
    
    public function isAdmin(): bool
    {
        return $this->role === 'customer';
    }

    public function hasInWishlist(Product $product): bool
    {
        return $this->wishlist()
                    ->where('product_id', $product->id)
                    ->exisits();
    }
}

