<?php

namespace App\Models;

use App\Enums\CategoryOld;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'category' => Category::class,
    ];

    public function products(): hasMany{
        return $this->hasMany(Product::class);
    }

    public function shop(): BelongsToMany{
        return $this->belongsToMany(Shop::Class, "products_shops", "product_id", "shop_id")
            ->withPivot('product_link', 'rating', 'price');
    }
}

