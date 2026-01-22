<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\CreateProductUseCase;
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

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
