<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\BoardMember\AddRequest;
use App\Http\Requests\Frontend\BoardMember\UpdateRequest;
use App\Models\BoardComitteeMember;
use App\Services\BoardMemberServices;
use Illuminate\Http\Request;

class BoardComitteeMemberController extends BaseController
{
    public function __construct(
        protected BoardMemberServices $boardmember
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

        $data = BoardComitteeMember::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/boardMember/store",
     *     tags={"Board Committee Member"},
     *     summary="Create a new Board Committee Member",
     *     operationId="storeBoardCommitteeMember",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "organization_name", "Sector", "designation", "committee_name", "start_date", "end_date", "status", "affidavit"},
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="organization_name", type="string", example="ABC Organization"),
     *             @OA\Property(property="Sector", type="string", example="Private"),
     *             @OA\Property(property="designation", type="string", example="Chairman"),
     *             @OA\Property(property="committee_name", type="string", example="Audit Committee"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-12-31"),
     *             @OA\Property(property="status", type="string", example="Active"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Board Committee Member added successfully",
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
        $data = $this->boardmember->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/boardMember/show",
     *     tags={"Board Committee Member"},
     *     summary="Get a specific Board Committee Member by ID",
     *     operationId="showBoardCommitteeMember",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the Board Committee Member"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Board Committee Member retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="organization_name", type="string", example="ABC Organization"),
     *             @OA\Property(property="Sector", type="string", example="Private"),
     *             @OA\Property(property="designation", type="string", example="Chairman"),
     *             @OA\Property(property="committee_name", type="string", example="Audit Committee"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-12-31"),
     *             @OA\Property(property="status", type="string", example="Active"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Board Committee Member not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(Request $request)
    {
        $data = BoardComitteeMember::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/boardMember/update",
     *     tags={"Board Committee Member"},
     *     summary="Update a Board Committee Member",
     *     operationId="updateBoardCommitteeMember",
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
     *             @OA\Property(property="organization_name", type="string", example="Updated Organization"),
     *             @OA\Property(property="Sector", type="string", example="Government"),
     *             @OA\Property(property="designation", type="string", example="Member"),
     *             @OA\Property(property="committee_name", type="string", example="HR Committee"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-02-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-11-30"),
     *             @OA\Property(property="status", type="string", example="Inactive"),
     *             @OA\Property(property="affidavit", type="string", example="updated_affidavit.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Board Committee Member updated successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="update data successfully!."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Board Committee Member not found"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->boardmember->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/boardMember/delete",
     *     tags={"Board Committee Member"},
     *     summary="Delete a Board Committee Member",
     *     operationId="deleteBoardCommitteeMember",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the Board Committee Member to delete"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Board Committee Member deleted successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="delete data successfully"),
     *             @OA\Property(property="data", type="object", nullable=true)
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Data not found"),
     *     @OA\Response(response=500, description="Failed to delete data"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->boardmember->delete($request->id);

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
