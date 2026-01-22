<?php

namespace App\UseCases;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ReadAllProductsUseCase
{
    public function execute(): Collection
    {
        return Product::all();
    }
}
