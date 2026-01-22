<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#useCases
use App\UseCases\CreateProductUseCase;
use App\UseCases\DeleteProductUseCase;
use App\UseCases\ReadProductUseCase;
use App\UseCases\ReadAllProductsUseCase;
use App\UseCases\ReadProductsByCategoryUseCase;
use App\UseCases\UpdateProductUseCase;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReadAllProductsUseCase $useCase)
    {
        $products = $useCase->execute();

        return response()->json($products, 200);
    }


    public function store(Request $request, CreateProductUseCase $useCase)
    {
       $validated = $request->validate([
            'name'     => 'required|unique:products|max:100',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0|max:130',
            'quantity' => 'required|integer|min:0',
        ]);
        $product = $useCase->execute($validated);

        return response()->json($product, 201);
    }

    public function showByName(string $name, ReadProductUseCase $useCase)
    {
       $product = $useCase->execute($name);

        if (!$product) {
            return response()->json(['message' => 'Café não encontrado'], 404);
        }

        return response()->json($product);
    }

    public function showByCategory(string $category, ReadProductsByCategoryUseCase $useCase)
    {
       $products = $useCase->execute($category);

        return response()->json($products, 200);
    }


    public function update(Request $request, UpdateProductUseCase $useCase)
    {
        $validated = $request->validate([
        'id'       => 'required|exists:products,id',
        'name'     => 'string|max:100',
        'category' => 'string',
        'price'    => 'numeric|min:0',
        'quantity' => 'integer|min:0',
        ]);

        $product = $useCase->execute($validated);

        return response()->json([
        'message' => 'Product updated with success',
        'product' => $product
        ]);
    }

    public function destroy(string $name, DeleteProductUseCase $useCase)
    {
       $deletedProduct = $useCase->execute($name);

        return response()->json([
            'message' => 'Product deleted with success',
            'product' => $deletedProduct
        ], 200);
    }
}
