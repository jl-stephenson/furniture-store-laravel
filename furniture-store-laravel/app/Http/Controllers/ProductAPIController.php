<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductAPIController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'width' => 'required|integer|min:1'
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->depth = $request->depth;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->related = $request->related;
        $product->color = $request->color;
        $product->save();

        return response()->json(['success' => true]);

    }
}
