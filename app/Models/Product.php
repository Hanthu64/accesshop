<?php

namespace App\Models;

use App\Enums\CategoryOld;
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
        'description'
    ];

    public function category(): belongsTo{
        return $this->belongsTo(Category::class);
    }

    public function shop(): BelongsToMany{
        return $this->belongsToMany(Shop::Class, "products_shops", "product_id", "shop_id")
            ->withPivot('product_link', 'rating', 'price');
    }
}
