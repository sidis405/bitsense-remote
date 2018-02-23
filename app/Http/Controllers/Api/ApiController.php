<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * @SWG\Swagger(
     *   basePath="/api/",
     *   @SWG\Info(
     *      title="Bitsense Blog Api",
     *      description="REST API",
     *      version="0.1",
     *      termsOfService="terms",
     *      @SWG\Contact(name="forge405@gmail.com"),
     *      @SWG\License(name="Proprietary License")
     *   )
     * )
     * @SWG\SecurityScheme(
     *          securityDefinition="default",
     *          type="apiKey",
     *          in="header",
     *          name="Authorization"
     *      )
     */
}
