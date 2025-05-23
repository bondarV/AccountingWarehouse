<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        $general_quantity = Inventory::where('product_id', $product->id)->get()->sum('quantity');

        $warehouses = $product->warehouses()
            ->withPivot('quantity')
            ->paginate(5);

        return view('products.show', ['product' => $product, 'general_quantity' => $general_quantity, 'warehouses' => $warehouses]);

    }
}
