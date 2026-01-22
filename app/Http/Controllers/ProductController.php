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
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Products",
    description: "Endpoints for managing products in the coffee inventory"
)]
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    #[OA\Get(
        path: "/api/products",
        summary: "List all products",
        description: "Returns a list of all products available in the inventory",
        tags: ["Products"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Product")
                )
            )
        ]
    )]
    public function index(ReadAllProductsUseCase $useCase)
    {
        $products = $useCase->execute();

        return response()->json($products, 200);
    }


    #[OA\Post(
        path: "/api/products",
        summary: "Create a new product",
        description: "Creates a new product in the inventory",
        tags: ["Products"],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                "application/json" => new OA\JsonContent(
                    ref: "#/components/schemas/Product"
                )
            ]
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Product created successfully",
                content: new OA\JsonContent(ref: "#/components/schemas/Product")
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
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

    #[OA\Get(
        path: "/api/products/search/name/{name}",
        summary: "Get product by name",
        description: "Returns a product that matches the given name",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "name",
                in: "path",
                required: true,
                description: "Name of the product to search",
                schema: new OA\Schema(type: "string")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Product found",
                content: new OA\JsonContent(ref: "#/components/schemas/Product")
            ),
            new OA\Response(
                response: 404,
                description: "Product not found"
            )
        ]
    )]
    public function showByName(string $name, ReadProductUseCase $useCase)
    {
        $product = $useCase->execute($name);

        if (!$product) {
            return response()->json(['message' => 'Café não encontrado'], 404);
        }

        return response()->json($product);
    }

     #[OA\Get(
        path: "/api/products/search/category/{category}",
        summary: "Get products by category",
        description: "Returns all products that belong to a specific category",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "category",
                in: "path",
                required: true,
                description: "Category name to filter products",
                schema: new OA\Schema(type: "string")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful operation",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Product")
                )
            )
        ]
    )]
    public function showByCategory(string $category, ReadProductsByCategoryUseCase $useCase)
    {
        $products = $useCase->execute($category);

        return response()->json($products, 200);
    }


     #[OA\Put(
        path: "/api/products",
        summary: "Update a product",
        description: "Updates an existing product in the inventory",
        tags: ["Products"],
        requestBody: new OA\RequestBody(
            required: true,
            content: [
                "application/json" => new OA\JsonContent(
                    ref: "#/components/schemas/Product"
                )
            ]
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Product updated successfully",
                content: new OA\JsonContent(ref: "#/components/schemas/Product")
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            ),
            new OA\Response(
                response: 404,
                description: "Product not found"
            )
        ]
    )]
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

    #[OA\Delete(
        path: "/api/products/{name}",
        summary: "Delete a product by name",
        description: "Deletes the product with the specified name from the inventory",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "name",
                in: "path",
                required: true,
                description: "Name of the product to delete",
                schema: new OA\Schema(type: "string")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Product deleted successfully",
                content: new OA\JsonContent(ref: "#/components/schemas/Product")
            ),
            new OA\Response(
                response: 404,
                description: "Product not found"
            )
        ]
    )]
    public function destroy(string $name, DeleteProductUseCase $useCase)
    {
        $deletedProduct = $useCase->execute($name);

        return response()->json([
            'message' => 'Product deleted with success',
            'product' => $deletedProduct
        ], 200);
    }
}
