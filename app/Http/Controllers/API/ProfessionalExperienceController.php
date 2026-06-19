<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\professionalExperience\AddRequest;
use App\Http\Requests\Frontend\professionalExperience\UpdateRequest;
use App\Models\ProfessionalExperience;
use App\Services\ProExperienceServices;
use Illuminate\Http\Request;

class ProfessionalExperienceController extends BaseController
{
    public function __construct(
        protected ProExperienceServices $professionalexperienceService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/professional/experience/list",
     *     tags={"Professional Experience"},
     *     summary="List Professional Experiences by user_id",
     *     operationId="getProfessionalExperienceList",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID to fetch experiences",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of professional experiences",
     *
     *         @OA\JsonContent(type="array", @OA\Items())
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="No experiences found"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $data = ProfessionalExperience::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/professional/experience/store",
     *     tags={"Professional Experience"},
     *     summary="Store Professional Experience",
     *     operationId="storeProfessionalExperience",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={
     *                 "user_id", "job_title", "organization_name", "job_description",
     *                 "start_date", "end_date", "Country", "affidavit"
     *             },
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="job_title", type="string", example="Software Engineer"),
     *             @OA\Property(property="organization_name", type="string", example="Google"),
     *             @OA\Property(property="job_description", type="string", example="Backend development in Laravel"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2020-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="Country", type="string", example="Pakistan"),
     *             @OA\Property(property="affidavit", type="string", example="documents/experience_letter.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Professional Experience created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(AddRequest $request)
    {
        $data = $this->professionalexperienceService->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/professional/experience/show",
     *     tags={"Professional Experience"},
     *     summary="Show single Professional Experience",
     *     operationId="showProfessionalExperience",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="Experience ID",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Experience data",
     *
     *         @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Experience not found"
     *     )
     * )
     */
    public function show(Request $request)
    {
        $data = ProfessionalExperience::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/professional/experience/update",
     *     tags={"Professional Experience"},
     *     summary="Update Professional Experience",
     *     operationId="updateProfessionalExperience",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="job_title", type="string", example="Senior Engineer"),
     *             @OA\Property(property="organization_name", type="string", example="Google"),
     *             @OA\Property(property="job_description", type="string", example="Updated job description"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2020-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="Country", type="string", example="Pakistan"),
     *             @OA\Property(property="affidavit", type="string", example="documents/experience_letter_updated.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Experience updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Experience not found"
     *     )
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->professionalexperienceService->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/professional/experience/delete",
     *     tags={"Professional Experience"},
     *     summary="Delete Professional Experience",
     *     operationId="deleteProfessionalExperience",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="Experience ID to delete",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Experience deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Experience not found"
     *     )
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->professionalexperienceService->delete($request->id);

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
