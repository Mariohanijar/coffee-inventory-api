<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Product",
    type: "object",
    description: "Product entity representing an item in the coffee inventory",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Espresso Coffee"),
        new OA\Property(property: "category", type: "string", example: "Beans"),
        new OA\Property(property: "price", type: "number", format: "float", example: 15.90),
        new OA\Property(property: "quantity", type: "integer", example: 10),
        new OA\Property(property: "created_at", type: "string", format: "date-time"),
        new OA\Property(property: "updated_at", type: "string", format: "date-time"),
    ]
)]
class ProductSchema {}
