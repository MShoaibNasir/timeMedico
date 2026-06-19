<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\DirectorShip\AddRequest;
use App\Http\Requests\Frontend\DirectorShip\UpdateRequest;
use App\Models\Directorship;
use App\Services\DirectorShipServices;
use Illuminate\Http\Request;

class DirectorShipController extends BaseController
{
    public function __construct(
        protected DirectorShipServices $directorshipServices
    ) {}

    /**
     * @OA\Get(
     *     path="/api/directorship/list",
     *     tags={"Directorship"},
     *     summary="Get list of Directorship entries by user ID",
     *     operationId="getDirectorshipList",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID to filter directorship entries",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of directorship records",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="organization_name", type="string", example="TechCorp Ltd."),
     *                 @OA\Property(property="Sector", type="string", example="Technology"),
     *                 @OA\Property(property="designation", type="string", example="Director of Operations"),
     *                 @OA\Property(property="executive", type="string", example="Yes"),
     *                 @OA\Property(property="start_date", type="string", format="date", example="2020-01-01"),
     *                 @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *                 @OA\Property(property="status", type="string", example="Active"),
     *                 @OA\Property(property="affidavit", type="string", example="affidavit.pdf")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="No directorship records found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index(Request $request)
    {
        $data = Directorship::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/directorship/store",
     *     tags={"Directorship"},
     *     summary="Create a new Directorship entry",
     *     operationId="storeDirectorship",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "organization_name", "Sector", "designation", "executive", "start_date", "end_date", "status", "affidavit"},
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="organization_name", type="string", example="TechCorp Ltd."),
     *             @OA\Property(property="Sector", type="string", example="Technology"),
     *             @OA\Property(property="designation", type="string", example="Director of Operations"),
     *             @OA\Property(property="executive", type="string", example="Yes"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2020-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="status", type="string", example="Active"),
     *             @OA\Property(property="affidavit", type="string", format="binary")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Directorship entry created successfully",
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
        $data = $this->directorshipServices->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/directorship/show",
     *     tags={"Directorship"},
     *     summary="Get single Directorship record by ID",
     *     operationId="getDirectorshipById",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="ID of the directorship record",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Directorship record retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="organization_name", type="string", example="TechCorp Ltd."),
     *             @OA\Property(property="Sector", type="string", example="Technology"),
     *             @OA\Property(property="designation", type="string", example="Director of Operations"),
     *             @OA\Property(property="executive", type="string", example="Yes"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2020-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="status", type="string", example="Active"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Directorship record not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(Request $request)
    {
        $data = Directorship::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/directorship/update",
     *     tags={"Directorship"},
     *     summary="Update a Directorship record",
     *     operationId="updateDirectorship",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="organization_name", type="string", example="TechCorp Ltd."),
     *             @OA\Property(property="Sector", type="string", example="Technology"),
     *             @OA\Property(property="designation", type="string", example="Managing Director"),
     *             @OA\Property(property="executive", type="string", example="Yes"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2021-05-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-05-01"),
     *             @OA\Property(property="status", type="string", example="Active"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit_updated.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Directorship record updated successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="update data successfully!."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Directorship record not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->directorshipServices->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/directorship/delete",
     *     tags={"Directorship"},
     *     summary="Delete a Directorship record",
     *     operationId="deleteDirectorship",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="ID of the directorship record to delete",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Directorship record deleted successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="delete data successfully"),
     *             @OA\Property(property="data", type="object", nullable=true)
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Directorship record not found"),
     *     @OA\Response(response=500, description="Failed to delete data"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->directorshipServices->delete($request->id);

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
