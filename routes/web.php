<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('about');
});

Route::get('/branches', function () {
    return view('branches');
});

Route::get('/products', function () {
    return view('products', ['products' => [['id' => 1, 'title' => 'pelmeni', 'amount' => 5000],
        ['id' => 2, 'title' => 'sour cream', 'amount' => 1000],
        ['id' => 3, 'title' => 'vareniki', 'amount' => 1223]]]);
});
Route::get('/products/{id}', function ($id) {
    $products = [['id' => 1, 'title' => 'pelmeni', 'amount' => 5000],
        ['id' => 2, 'title' => 'sour cream', 'amount' => 1000],
        ['id' => 3, 'title' => 'vareniki', 'amount' => 1223]];

    $product = collect($products)->first(fn($product) => $product['id'] == $id);
    $product = Arr::first($products,fn($product) => $product['id'] == $id);
    if (!$product) {
        abort(404);
    }

    return view('product', ['product' => $product]);

});


