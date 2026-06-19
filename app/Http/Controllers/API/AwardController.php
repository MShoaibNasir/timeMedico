<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\Award\AddRequest;
use App\Http\Requests\Frontend\Award\UpdateRequest;
use App\Models\Award;
use App\Services\AwardServices;
use Illuminate\Http\Request;

class AwardController extends BaseController
{
    public function __construct(
        protected AwardServices $awardServices
    ) {}

    /**
     * @OA\Get(
     *     path="/api/award/list",
     *     tags={"Award"},
     *     summary="Get all awards by User ID",
     *     operationId="getAwardList",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the user whose awards are to be listed"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of awards retrieved successfully",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="title", type="string", example="Best Developer"),
     *                 @OA\Property(property="organization", type="string", example="XYZ Inc."),
     *                 @OA\Property(property="evaluation_period", type="string", example="2023-2024"),
     *                 @OA\Property(property="comments", type="string", example="Excellent contribution"),
     *                 @OA\Property(property="affidavit", type="string", example="award_affidavit.pdf")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="No awards found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index(Request $request)
    {
        $data = Award::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/award/store",
     *     tags={"Award"},
     *     summary="Create a new Award entry",
     *     operationId="storeAward",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "title", "organization", "evaluation_period", "comments", "affidavit"},
     *
     *             @OA\Property(property="user_id", type="integer", example=5, description="ID of the user receiving the award"),
     *             @OA\Property(property="title", type="string", maxLength=50, example="Best Performer", description="Title of the award"),
     *             @OA\Property(property="organization", type="string", maxLength=50, example="ABC Corp", description="Organization giving the award"),
     *             @OA\Property(property="evaluation_period", type="string", maxLength=50, example="Jan-Dec 2024", description="Evaluation period for the award"),
     *             @OA\Property(property="comments", type="string", maxLength=50, example="Outstanding performance", description="Comments or reason for the award"),
     *             @OA\Property(property="affidavit", type="string", example="award_affidavit.pdf", description="Affidavit file name or path")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Award created successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Add Data Successfully!."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(AddRequest $request)
    {
        $data = $this->awardServices->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/award/show",
     *     tags={"Award"},
     *     summary="Get a specific Award by ID",
     *     operationId="showAward",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the award to retrieve"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Award details retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=5),
     *             @OA\Property(property="title", type="string", example="Best Performer"),
     *             @OA\Property(property="organization", type="string", example="ABC Corp"),
     *             @OA\Property(property="evaluation_period", type="string", example="Jan-Dec 2024"),
     *             @OA\Property(property="comments", type="string", example="Outstanding performance"),
     *             @OA\Property(property="affidavit", type="string", example="award_affidavit.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Award not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(Request $request)
    {
        $data = Award::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/award/update",
     *     tags={"Award"},
     *     summary="Update an existing Award entry",
     *     operationId="updateAward",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1, description="ID of the award to update"),
     *             @OA\Property(property="title", type="string", example="Updated Title", description="Updated title of the award"),
     *             @OA\Property(property="organization", type="string", example="Updated Organization", description="Updated organization"),
     *             @OA\Property(property="evaluation_period", type="string", example="Updated Period", description="Updated evaluation period"),
     *             @OA\Property(property="comments", type="string", example="Updated Comments", description="Updated comments"),
     *             @OA\Property(property="affidavit", type="string", example="updated_affidavit.pdf", description="Updated affidavit file name or path")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Award updated successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="update data successfully!."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Award not found"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->awardServices->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/award/delete",
     *     tags={"Award"},
     *     summary="Delete an Award by ID",
     *     operationId="deleteAward",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the award to delete"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Award deleted successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="delete data successfully"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Award not found"),
     *     @OA\Response(response=500, description="Failed to delete data"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->awardServices->delete($request->id);

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
