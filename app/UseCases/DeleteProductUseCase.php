<?php

namespace App\UseCases;

use App\Models\Product;

class DeleteProductUseCase
{
    public function execute(string $name): Product
    {
        $cleanName = trim($name);
        $product = Product::where('name', 'ILIKE', $cleanName)->firstOrFail();
        $product->delete();

        return $product;
    }
}
