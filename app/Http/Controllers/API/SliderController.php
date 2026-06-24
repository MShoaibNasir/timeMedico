<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\Education\AddRequest;
use App\Http\Requests\Frontend\Education\DeleteRequest;
use App\Http\Requests\Frontend\Education\UpdateRequest;
use App\Models\HomeSlider;
use App\Services\EducationServices;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class SliderController extends BaseController
{
     
    public function index(Request $request)
    {
        $data = HomeSlider::where('status', 1)->select('image')->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/education/store",
     *     tags={"Education"},
     *     summary="Store Education",
     *     operationId="storeEducation",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={
     *                 "user_id", "degree", "degree_title", "majors",
     *                 "institute_name", "board_name", "start_date",
     *                 "end_date", "obtained_marks", "total_marks",
     *                 "obtained_percentage", "grade", "foreign_qualified",
     *                 "education_document"
     *             },
     *
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="degree", type="string", example="BS"),
     *             @OA\Property(property="degree_title", type="string", example="BS Computer Science"),
     *             @OA\Property(property="majors", type="string", example="Computer Science"),
     *             @OA\Property(property="institute_name", type="string", example="Virtual University"),
     *             @OA\Property(property="board_name", type="string", example="BISE Lahore"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2021-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="obtained_marks", type="integer", example=850),
     *             @OA\Property(property="total_marks", type="integer", example=1100),
     *             @OA\Property(property="obtained_percentage", type="number", format="float", example=77.27),
     *             @OA\Property(property="grade", type="string", example="A"),
     *             @OA\Property(property="foreign_qualified", type="string", enum={"Yes", "No"}, example="No"),
     *             @OA\Property(property="education_document", type="string", example="documents/degree.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Education created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(AddRequest $request)
    {
        $data = $this->educationService->store($request->all());

        return $this->sendResponse($data, 'Education Create Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/education/show",
     *     tags={"Education"},
     *     summary="Get education record by ID",
     *     operationId="showEducation",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         description="ID of the education record",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *
     *         @OA\JsonContent(type="object")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function show(Request $request)
    {
        $data = Education::find($request->id);

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/education/update",
     *     tags={"Education"},
     *     summary="Update Education",
     *     operationId="updateEducation",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id", "user_id", "degree", "degree_title", "majors", "institute_name", "board_name", "start_date", "end_date", "obtained_marks", "total_marks", "obtained_percentage", "grade", "foreign_qualified", "education_document"},
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="degree", type="string", example="BS Computer Science"),
     *             @OA\Property(property="degree_title", type="string", example="Bachelor of Science"),
     *             @OA\Property(property="majors", type="string", example="Computer Science"),
     *             @OA\Property(property="institute_name", type="string", example="Virtual University"),
     *             @OA\Property(property="board_name", type="string", example="HEC"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2021-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="obtained_marks", type="integer", example=800),
     *             @OA\Property(property="total_marks", type="integer", example=1000),
     *             @OA\Property(property="obtained_percentage", type="number", format="float", example=80.5),
     *             @OA\Property(property="grade", type="string", example="A"),
     *             @OA\Property(property="foreign_qualified", type="string", enum={"Yes", "No"}, example="No"),
     *             @OA\Property(property="education_document", type="string", format="binary")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Education updated successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Education not found"
     *     )
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->educationService->update($request->all());

        return $this->sendResponse($data, 'Education update Successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/education/delete",
     *     tags={"Education"},
     *     summary="Delete Education",
     *     operationId="deleteEducation",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the education to delete",
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Education deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Education not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to delete education"
     *     )
     * )
     */
    public function delete(DeleteRequest $request)
    {

        try {
            $data = $this->educationService->delete($request->id);

            return $this->sendResponse($data, 'Education deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendError('Education not found', [], 404);
        } catch (\Exception $e) {
            return $this->sendError('Failed to delete education', [
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
