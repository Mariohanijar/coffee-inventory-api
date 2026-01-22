<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Coffee Inventory API",
    description: "REST API for managing coffee shop inventory, products and stock levels."
)]
#[OA\Server(
    url: "http://brew-control.test",
    description: "Local development server"
)]
class OpenApiSpec
{
    // This class exists only to hold OpenAPI metadata
}
