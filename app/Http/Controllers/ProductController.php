<?php

namespace App\Http\Controllers;

use App\Enums\CategoryOld;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $q){
        $products = Product::query();
        $categories = Category::all();

        if($q -> filled('search')){
            $products = $products -> where('name', 'like', '%' . $q -> search . '%');
        }

        if($q -> filled('category')){
            $products = $products -> where('category_id', 'like', $q -> category);
        }

        $products = $products -> paginate(10);

        foreach($products as $product){
            if($q->filled('shopPreviewSorter') && $q->shopPreviewSorter == 2){
                $product->setRelation('shop', $product->shop->sortByDesc(fn($shop) => $shop->pivot->rating)->values());
            }else{
                $product->setRelation('shop', $product->shop->sortBy(fn($shop) => $shop->pivot->price)->values());
            }
        }

        return view('index', compact('products', 'categories'));
    }

    public function individualSearch(Request $q){
        $categories = Category::all();
        $shops = Shop::orderBy('name', 'asc') -> get();
        $products = DB::table('products_shops')
            ->join('products', 'products_shops.product_id', '=', 'products.id')
            ->join('shops', 'products_shops.shop_id', '=', 'shops.id')
            ->select('products.name as product_name',
                'shops.name as shop_name',
                'products.image as product_image',
                'shops.image as shop_image',
                'products.*',
                'shops.*',
                'products_shops.*');

        if($q -> filled('searchProdName')){
            $products = $products -> where('products.name', 'like', '%' . $q -> searchProdName . '%');
        }

        if($q -> filled('category')){
            $products = $products -> where('category_id', 'like', $q -> category);
        }

        if($q -> filled('shop')){
            $products = $products -> where('shop_id', $q -> shop);
        }

        if($q -> filled('price_min') && $q -> filled('price_max')) {
            $products = $products->whereBetween('products_shops.price', [
                $q->input('price_min'),
                $q->input('price_max')
            ]);
        }

        $products = $products -> get();

        if ($q->filled('sorter') && $q->sorter == 2) {
            $products = $products->sortByDesc('rating')->values();
        } else {
            $products = $products->sortBy('price')->values();
        }


        return view('individual-search', compact('products', 'categories', 'shops'));
    }

    public function filter($category){
        $products = Product::all();
        $products = $products->where('category', $category)->sortByDesc("rating");
        return view('index', compact('products'));
    }

    public function show($id, Request $request){
        $product = Product::query()->findOrFail($id);

        if($request -> query('sortBy') == "price"){
            $sorter = $product -> shop -> sortBy(function($product) {
                return $product->pivot->price;
            });
        }else{
            $sorter = $product -> shop -> sortByDesc(function($product) {
                return $product->pivot->rating;
            });
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentItems = $sorter->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator(
            $currentItems,
            $sorter->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('products-show', compact('product',  'paginator'));
    }

    public function create(){
        $categories = Category::all();
        return view('product-create-modal', compact('categories'));
    }
    public function delete($id){
        $product = Product::query()->find($id);
        $product -> shop() -> detach();
        $product->delete();
        return redirect('/profile');
    }

    public function edit($id){
        $shop = Shop::find(auth()->user()->shop_id);
        $product = $shop->product()->find($id);
        $categories = Category::all();
        return view('product-edit-modal', auth()->user(), compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        $shop = Shop::find(auth()->user()->shop_id);
        $product = $shop->product()->find($id);

        $product -> name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product -> image = $file -> store('images', 'public');
        }else if($request->input('image')){
            return back()->withErrors(['image' => 'Imagen no encontrada.']) -> withInput($request->input());
        }

        $product -> category = $request->input('category');

        $product -> description = $request->input('description');

        $product -> view_description = $request->input('view_description');

        $product -> pivot -> price = $request->input('price');

        $product -> pivot -> rating = $request->input('rating');

        $product -> pivot -> product_link = $request->input('link');

        $product -> save();

        $product -> pivot -> save();

        return back();
    }

    public function store(Request $request){
        $product = new Product();

        $product -> name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product -> image = $file -> store('images', 'public');
        }else if($request->input('image')){
            return back()->withErrors(['image' => 'Imagen no encontrada.']) -> withInput($request->input());
        }

        $product -> category = $request->input('category');

        $product -> description = $request->input('description');

        $product -> view_description = $request->input('view_description');

        $product -> save();

        $shop = Shop::find(auth()->user()->shop_id);

        $product->shop()->attach($shop->id, [
            'price' => $request->input('price'),
            'rating' => $request->input('rating'),
            'product_link' => $request->input('link'),
        ]);

        return back();
    }
}
