<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CurrencyCalculationService;
use Illuminate\Http\Request;
use App\Services\MeasurementCalculationService;

class ProductController extends Controller
{
    public function allProducts(Request $request) {
        $products = Product::all();
        $currency = CurrencyCalculationService::GBP;
        if (!empty($request->currency) && array_key_exists($request->currency, CurrencyCalculationService::UNITS)) {
            $currency = $request->currency;
        }

        foreach ($products as $product) {
            $product->price = CurrencyCalculationService::convertCurrency($product->price, $currency);
        }

        return view('products', ['products' => $products]);
    }

    public function individualProduct(int $id, Request $request) {
        $similarProduct = null;
        $product = Product::find($id);

        if (!is_null($product)) {
            $relatedId = $product->related;
            $similarProduct = Product::find($relatedId);
        }

        $unitOfMeasurement = MeasurementCalculationService::MM;

        if (!empty($request->unit) && array_key_exists($request->unit, MeasurementCalculationService::UNITS)) {
            $unitOfMeasurement = $request->unit;
        }

        $dimensionsArr = [$product->width, $product->height, $product->depth];
        $dimensionsArr = MeasurementCalculationService::convertUnits($dimensionsArr, $unitOfMeasurement);

        $currency = CurrencyCalculationService::GBP;
        if (!empty($request->currency) && array_key_exists($request->currency, CurrencyCalculationService::UNITS)) {
            $currency = $request->currency;
        }

        $product->price = CurrencyCalculationService::convertCurrency($product->price, $currency);

        if (!is_null($similarProduct)) {
            $similarProduct->price = CurrencyCalculationService::convertCurrency($similarProduct->price, $currency);
        }

        return view('product', ['product' => $product, 'similarProduct' => $similarProduct, 'dimensions' => $dimensionsArr]);
    }

    public function inStockProducts() {
        $products = Product::where('stock', '>', 0)->get();
        $currency = CurrencyCalculationService::GBP;
        if (!empty($request->currency) && array_key_exists($request->currency, CurrencyCalculationService::UNITS)) {
            $currency = $request->currency;
        }

        foreach ($products as $product) {
            $product->price = CurrencyCalculationService::convertCurrency($product->price, $currency);
        }
        return view('products', ['products' => $products]);
    }

}
