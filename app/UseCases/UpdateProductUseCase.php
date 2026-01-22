<?php

namespace App\UseCases;

use App\Models\Product;

class UpdateProductUseCase
{
    public function execute(array $data): Product
    {
        $product = Product::findOrFail($data['id']);

        $product->update($data);

        return $product;
    }
}
