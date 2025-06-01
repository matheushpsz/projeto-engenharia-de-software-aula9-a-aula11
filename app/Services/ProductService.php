<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService {
    private ProductRepository $productRepository;
    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function get() {
        $products = $this->productRepository->get();
        return $products;
    }
    public function details(int $id) {
        $product = $this->productRepository->details($id);
        return $product;
    }
    public function store(array $data) {
        $product = $this->productRepository->store($data);
        return $product;
    }
}