<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *  title="Senac Bike Store API",
 *  version="1.0.0",  
 *)
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
