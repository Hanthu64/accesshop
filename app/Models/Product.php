<?php

namespace App\Models;

use App\Enums\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'view_description',
        'description'
    ];

    protected $casts = [
        'category' => Category::class,
    ];

    public function shop(): BelongsToMany{
        return $this->belongsToMany(Shop::Class, "products_shops", "product_id", "shop_id")
            ->withPivot('product_link', 'rating', 'price');
    }
}
