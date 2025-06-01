<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository {
    public function get() {
        return Product::all();
    }
    public function details(int $id) {
        return Product::find($id);
    }
    public function store(array $data) {
        return Product::create($data);
    }
}



