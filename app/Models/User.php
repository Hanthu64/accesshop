<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\CategoryOld;
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
        'image',
        'email',
        'password',
    ];

    protected $casts = [
        'roles' => 'array',
    ];

    public function setFavouriteCategoriesAttribute(array $favourite_categories){
        $this->attributes['favourite_categories'] = json_encode(array_map(
            fn($category) => $category instanceof CategoryOld ? $category -> value : $category, $favourite_categories
        ));
    }

    public function getFavouriteCategoriesAttribute($value){
        $favourite_categories = json_decode($value, true) ?? [];
        return array_map(fn($category) => CategoryOld::from($category), $favourite_categories);
    }
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

    public function shop()
    {
        return $this->hasOne(Shop::class);
    }
}
