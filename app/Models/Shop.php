<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'homepage'
    ];

    public function product(): BelongsToMany{
        return $this->belongsToMany(Product::Class, "products_shops", "shop_id", "product_id")
        ->withPivot('product_link', 'rating', 'price');
    }

    public function users(){
        return $this -> hasMany(User::Class);
    }
}
