<?php

namespace App\UseCases;

use App\Models\Product;

class CreateProductUseCase
{
    public function execute(array $data): Product
    {
        return Product::create($data);
    }
}
