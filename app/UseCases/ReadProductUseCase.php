<?php

namespace App\UseCases;

use App\Models\Product;
use Illuminate\Support\Str;

class ReadProductUseCase
{
    public function execute(string $name): ?Product
    {
        $cleanName = trim($name);
        return Product::where('name', 'ILIKE', $cleanName)->firstOrFail();
    }
}
