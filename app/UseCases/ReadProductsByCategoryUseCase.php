<?php

namespace App\UseCases;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ReadProductsByCategoryUseCase
{
    public function execute(string $category): Collection
    {
        $cleanCategory = trim($category);
        return Product::where('category', 'ILIKE', $cleanCategory)->get();
    }
}
