<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\Skill\AddRequest;
use App\Http\Requests\Frontend\Skill\DeleteRequest;
use App\Http\Requests\Frontend\Skill\UpdateRequest;
use App\Models\Skill;
use App\Services\SkillServices;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    public function __construct(
        protected SkillServices $skillService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/skill",
     *     tags={"Skill"},
     *     summary="Get Skills by User ID",
     *     operationId="getSkills",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the user whose skills to retrieve"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of skills",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="skill_name", type="string", example="Laravel"),
     *                 @OA\Property(property="level", type="string", example="Intermediate")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="No skills found"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $data = Skill::all();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/skill",
     *     tags={"Skill"},
     *     summary="Create a new skill",
     *     operationId="storeSkill",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "name", "skill_proficiency","description"},
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Laravel"),
     *             @OA\Property(property="skill_proficiency", type="string", enum={"Beginner", "Intermediate", "Expert"}, example="Intermediate"),
     *             @OA\Property(property="description", type="string", example="Experience building RESTful APIs")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Skill created successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Laravel"),
     *                 @OA\Property(property="skill_proficiency", type="string", example="Intermediate"),
     *                 @OA\Property(property="description", type="string", example="Experience building RESTful APIs"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-06-11T10:45:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-06-11T10:45:00Z")
     *             ),
     *             @OA\Property(property="message", type="string", example="Skill Create Successfully!.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function store(AddRequest $request)
    {
        $data = $this->skillService->store($request->all());

        return $this->sendResponse($data, 'Skill Create Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/skill/show",
     *     tags={"Skill"},
     *     summary="Get skill details by ID",
     *     operationId="showSkill",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="ID of the skill to retrieve",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Skill retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Laravel"),
     *             @OA\Property(property="skill_proficiency", type="string", example="Expert"),
     *             @OA\Property(property="description", type="string", example="Developed APIs and admin dashboards."),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Skill not found"
     *     )
     * )
     */
    public function show(Request $request)
    {
        $data = Skill::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/skill/update",
     *     tags={"Skill"},
     *     summary="Update a skill",
     *     operationId="updateSkill",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"skill_id"},
     *
     *             @OA\Property(property="skill_id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Laravel"),

     *             @OA\Property(
     *                 property="skill_proficiency",
     *                 type="string",
     *                 enum={"Beginner", "Intermediate", "Expert"},
     *                 example="Expert"
     *             ),
     *             @OA\Property(property="description", type="string", example="Experience with Laravel framework.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Skill updated successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->skillService->update($request->all());

        return $this->sendResponse($data, 'Skill update Successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/skill/delete",
     *     tags={"Skill"},
     *     summary="Delete a skill by ID",
     *     operationId="deleteSkill",
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
     *     @OA\Response(
     *         response=200,
     *         description="Skill deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Skill not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to delete skill"
     *     )
     * )
     */
    public function delete(DeleteRequest $request)
    {

        try {
            $data = $this->skillService->delete($request->id);

            return $this->sendResponse($data, 'Skill deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendError('Skill not found', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete skill', [
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
