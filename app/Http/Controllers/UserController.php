<?php
namespace App\Http\Controllers;

use App\Enums\CategoryOld;
use App\Enums\Role;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function list(){
        $users = User::all();

        return view('users', compact('users'));
    }

    public function profile()
    {
        if (auth()->user()->role == 'provider') {
            $roles = null;
            $shop = Shop::find(auth()->user()->shop_id);
            $products = $shop->product;
            $users = null;
        } else if (auth()->user()->role == 'admin') {
            $roles = Role::cases();
            $shop = null;
            $products = DB::table('products_shops')
                ->join('products', 'products_shops.product_id', '=', 'products.id')
                ->join('shops', 'products_shops.shop_id', '=', 'shops.id')
                ->select('products.name as product_name',
                    'shops.name as shop_name',
                    'products.image as product_image',
                    'shops.image as shop_image',
                    'products.*',
                    'shops.*',
                    'products_shops.*')
                -> orderBy('products_shops.id')
                -> get();
            $users = User::all();
        } else {
            $roles = null;
            $shop = null;
            $products = null;
            $users = null;
        }

        return view('profile', auth()->user(), compact('roles', 'shop', 'products', 'users'));
    }

    public function edit($id){
        $user = User::find($id);
        $shops = Shop::all();
        $roles = Role::cases();

        return view('user-edit-modal', compact('user', 'roles', 'shops'));

    }
    public function delete($id){
        $user = User::query()->find($id);
        $user -> delete();
        return redirect('/profile');
    }
}
