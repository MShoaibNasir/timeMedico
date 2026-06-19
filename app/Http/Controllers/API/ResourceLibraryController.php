<?php

namespace App\Http\Controllers\API;

use App\Models\ResourceLibrary;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ResourceLibraryController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/library/list",
     *     tags={"Library"},
     *     summary="Get All Resource Library Items",
     *     operationId="getLibraryList",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of resource items"
     *     )
     * )
     */
    public function index(Request $request)
    {
        return ResourceLibrary::all();
    }
}
