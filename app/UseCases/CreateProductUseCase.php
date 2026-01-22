<?php

namespace App\UseCases;

use App\Models\Product;

class CreateProductUseCase
{
    public function execute(array $data): Product
    {
        $data['name'] = ucfirst(strtolower(trim($data['name'])));

        return Product::create($data);
    }
}
