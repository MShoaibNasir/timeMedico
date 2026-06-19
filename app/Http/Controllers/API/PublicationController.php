<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\Publications\AddRequest;
use App\Http\Requests\Frontend\Publications\UpdateRequest;
use App\Models\Publication;
use App\Services\PublicationServices;
use Illuminate\Http\Request;

class PublicationController extends BaseController
{
    public function __construct(
        protected PublicationServices $publicationServices
    ) {}

    /**
     * @OA\Get(
     *     path="/api/publications/list",
     *     tags={"Publications"},
     *     summary="List Publications by user_id",
     *     operationId="getPublicationsList",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID to fetch publications",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of publications",
     *
     *         @OA\JsonContent(type="array", @OA\Items())
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="No publications found"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $data = Publication::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/bio/profile/store",
     *     tags={"BioProfile"},
     *     summary="Create a new bio profile",
     *     operationId="storeBioProfile",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "name", "about"},
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="about", type="string", example="Experienced software developer.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Bio Profile created successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="about", type="string", example="Experienced software developer."),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-06-11T10:45:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-06-11T10:45:00Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Bio Profile created successfully.")
     *         )
     *     ),
     *
     *     @OA\Response(response=400, description="Bad request")
     * )
     */
    public function store(AddRequest $request)
    {
        $data = $this->publicationServices->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/publications/show",
     *     tags={"Publications"},
     *     summary="Get a single publication",
     *     operationId="showPublication",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="Publication ID",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publication details",
     *
     *         @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Publication not found"
     *     )
     * )
     */
    public function show(Request $request)
    {
        $data = Publication::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/publications/update",
     *     tags={"Publications"},
     *     summary="Update Publication",
     *     operationId="updatePublication",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Updated Title"),
     *             @OA\Property(property="topics", type="string", example="Updated Topics"),
     *             @OA\Property(property="publication_type", type="string", example="Conference Paper"),
     *             @OA\Property(property="published_date", type="string", format="date", example="2024-07-01"),
     *             @OA\Property(property="publisher_name", type="string", example="Elsevier"),
     *             @OA\Property(property="url", type="string", example="https://example.com/updated-publication"),
     *             @OA\Property(property="description", type="string", example="Updated description of the research.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publication updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Publication not found"
     *     )
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->publicationServices->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/publications/delete",
     *     tags={"Publications"},
     *     summary="Delete a publication",
     *     operationId="deletePublication",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="Publication ID to delete",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publication deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Publication not found"
     *     )
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->publicationServices->delete($request->id);

            return $this->sendResponse($data, 'delete data successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendError('data not found', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete data', [
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
