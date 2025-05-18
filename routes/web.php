<?php

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('about');
});

Route::get('/branches', function () {
    return view('branches');
});

Route::get('/products', function () {
    return view('products', ['products' => Product::all()]);
});
Route::get('/products/{id}',function($id){
    $product = Product::find($id);

    if (!$product) {
        abort(404);
    }

    return view('product', ['product' => $product]);

});


