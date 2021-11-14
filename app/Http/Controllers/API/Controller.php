<?php

namespace App\Http\Controllers\API;

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel OpenApi Documentation",
     *      description="L5 Swagger OpenApi. Mentor API documentation",
     *      @OA\Contact(
     *          email="mikhailgregurco@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.4.41",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )

     *
     * @OA\Tag(
     *     name="Mentor",
     *     description="API Endpoints of Mentor"
     * )
     * @OA\Get(
     *     path="/",
     *     description="Home page",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
}
