<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\BioProfile\AddRequest;
use App\Http\Requests\Frontend\BioProfile\UpdateRequest;
use App\Models\BioProfile;
use App\Services\BioProfileServices;
use Illuminate\Http\Request;

class BioProfileController extends BaseController
{
    public function __construct(
        protected BioProfileServices $bioProfileService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/bio/profile/list",
     *     tags={"BioProfile"},
     *     summary="Get Bio Profiles by User ID",
     *     operationId="getBioProfiles",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the user whose bio profile is to be retrieved"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of Bio Profiles",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="about", type="string", example="Developer with 5 years experience.")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="No bio profiles found")
     * )
     */
    public function index(Request $request)
    {
        $data = BioProfile::where('user_id', $request->user_id)->get();

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
        $data = $this->bioProfileService->store($request->all());

        return $this->sendResponse($data, 'Add Data in Bio Profile Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/bio/profile/show",
     *     tags={"BioProfile"},
     *     summary="Get Bio Profile by ID",
     *     operationId="showBioProfile",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="ID of the bio profile to retrieve",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Bio Profile retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="about", type="string", example="Experienced Laravel Developer.")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Bio Profile not found")
     * )
     */
    public function show(Request $request)
    {
        $data = BioProfile::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/bio/profile/update",
     *     tags={"BioProfile"},
     *     summary="Update a Bio Profile",
     *     operationId="updateBioProfile",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id", "user_id", "name", "about"},
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Updated"),
     *             @OA\Property(property="about", type="string", example="Updated bio info.")
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Bio Profile updated successfully"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->bioProfileService->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/bio/profile/delete",
     *     tags={"BioProfile"},
     *     summary="Delete a Bio Profile by ID",
     *     operationId="deleteBioProfile",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Bio Profile deleted successfully"),
     *     @OA\Response(response=404, description="Bio Profile not found"),
     *     @OA\Response(response=500, description="Failed to delete Bio Profile")
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->bioProfileService->delete($request->id);

            return $this->sendResponse($data, 'delete data from bio profile successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendError('bio profile data not found', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete bio profile data', [
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
