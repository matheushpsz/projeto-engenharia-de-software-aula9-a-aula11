<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function get()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function details( int $id) {
        $product = $this->productService->details($id);
        return response()->json($product);
    }
    public function store(Request $request) {
        $data = $request->all();
        $product = $this->productService->store($data);
        return response()->json($product, 201);   
    }
}
