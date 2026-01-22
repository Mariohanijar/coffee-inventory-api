<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductRequest",
    type: "object",
    required: ["name", "category", "price", "quantity"],
    description: "Data required to create or update a product",
    properties: [
        new OA\Property(
            property: "name",
            type: "string",
            description: "The name of the product",
            example: "Espresso Coffee"
        ),
        new OA\Property(
            property: "category",
            type: "string",
            description: "The category of the product (e.g., Beans, Capsules)",
            example: "Beans"
        ),
        new OA\Property(
            property: "price",
            type: "number",
            format: "float",
            description: "The price of the product in local currency",
            example: 15.90
        ),
        new OA\Property(
            property: "quantity",
            type: "integer",
            description: "Available quantity in stock",
            example: 10
        )
    ]
)]
#[OA\Schema(
    schema: "ProductResponse",
    type: "object",
    description: "Representation of a product in the inventory",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "Unique product ID", example: 1),
        new OA\Property(property: "name", type: "string", description: "Name of the product", example: "Espresso Coffee"),
        new OA\Property(property: "category", type: "string", description: "Product category", example: "Beans"),
        new OA\Property(property: "price", type: "number", format: "float", description: "Product price", example: 15.90),
        new OA\Property(property: "quantity", type: "integer", description: "Stock quantity", example: 10),
        new OA\Property(property: "created_at", type: "string", format: "date-time", description: "Record creation timestamp"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time", description: "Record last update timestamp")
    ]
)]
class ProductSchema {}
