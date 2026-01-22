<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\CreateProductUseCase;
use App\UseCases\DeleteProductUseCase;
use App\UseCases\ReadProductUseCase;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $name, DeleteProductUseCase $useCase)
    {
       $deletedProduct = $useCase->execute($name);

        return response()->json([
            'message' => 'Produto removido com sucesso!',
            'product' => $deletedProduct
        ], 200);
    }
}
