<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Mentor OpenApi Documentation",
     *      description="L5 Swagger OpenApi. Mentor API documentation",
     *      @OA\Contact(
     *          email="mikhailgregurco@gmail.com"
     *      ),
     *
     *      @OA\SecurityScheme(
     *          scheme="Bearer",
     *          securityScheme="Bearer",
     *          type="apiKey",
     *          in="header",
     *          name="Authorization",
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     */
}
