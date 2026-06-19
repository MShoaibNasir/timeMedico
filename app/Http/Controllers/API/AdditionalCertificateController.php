<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Frontend\AdditionalCertificate\AddRequest;
use App\Http\Requests\Frontend\AdditionalCertificate\UpdateRequest;
use App\Models\AdditionalCertificate;
use App\Services\AddtionalCertificateServices;
use Illuminate\Http\Request;

class AdditionalCertificateController extends BaseController
{
    public function __construct(
        protected AddtionalCertificateServices $additionalCertificateService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/additional/certificate/list",
     *     tags={"AdditionalCertificate"},
     *     summary="Get Additional Certificates by User ID",
     *     operationId="getAdditionalCertificates",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the user whose additional certificates are to be retrieved"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of Additional Certificates",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="certificate_title", type="string", example="AWS Certified Developer"),
     *                 @OA\Property(property="issued_by", type="string", example="Amazon"),
     *                 @OA\Property(property="issue_date", type="string", format="date", example="2023-06-15")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="No additional certificates found")
     * )
     */
    public function index(Request $request)
    {
        $data = AdditionalCertificate::where('user_id', $request->user_id)->get();

        return $data;
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/additional/certificate/store",
     *     tags={"AdditionalCertificate"},
     *     summary="Store a new Additional Certificate",
     *     operationId="storeAdditionalCertificate",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"user_id", "certificate_title", "skills", "issuing_organization", "issue_date", "affidavit"},
     *
     *             @OA\Property(property="user_id", type="integer", example=5),
     *             @OA\Property(property="certificate_title", type="string", example="AWS Certified Developer"),
     *             @OA\Property(property="skills", type="string", example="Laravel, Vue.js, REST APIs"),
     *             @OA\Property(property="issuing_organization", type="string", example="Amazon"),
     *             @OA\Property(property="issue_date", type="string", format="date", example="2024-06-01"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit_file.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Certificate added successfully",
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
        $data = $this->additionalCertificateService->store($request->all());

        return $this->sendResponse($data, 'Add Data Successfully!.');
    }

    /**
     * @OA\Get(
     *     path="/api/additional/certificate/show",
     *     tags={"AdditionalCertificate"},
     *     summary="Show a single Additional Certificate by ID",
     *     operationId="showAdditionalCertificate",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the additional certificate"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Single Additional Certificate retrieved",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=5),
     *             @OA\Property(property="certificate_title", type="string", example="AWS Certified Developer"),
     *             @OA\Property(property="skills", type="string", example="Laravel, Vue.js"),
     *             @OA\Property(property="issuing_organization", type="string", example="Amazon"),
     *             @OA\Property(property="issue_date", type="string", format="date", example="2024-06-01"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit_file.pdf")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Certificate not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(Request $request)
    {
        $data = AdditionalCertificate::find($request->id);

        return $data;
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/additional/certificate/update",
     *     tags={"AdditionalCertificate"},
     *     summary="Update fields of an existing Additional Certificate",
     *     operationId="updateAdditionalCertificate",
     *     security={{"sanctum":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id"},
     *
     *             @OA\Property(property="id", type="integer", example=1, description="ID of the certificate to update"),
     *             @OA\Property(property="user_id", type="integer", example=5, description="(Optional) User ID"),
     *             @OA\Property(property="certificate_title", type="string", example="Updated AWS Certified Developer", description="(Optional) Title of the certificate"),
     *             @OA\Property(property="skills", type="string", example="Laravel, Vue.js", description="(Optional) Skills mentioned on the certificate"),
     *             @OA\Property(property="issuing_organization", type="string", example="Amazon", description="(Optional) Organization that issued the certificate"),
     *             @OA\Property(property="issue_date", type="string", format="date", example="2024-06-01", description="(Optional) Issue date of the certificate"),
     *             @OA\Property(property="affidavit", type="string", example="affidavit_updated.pdf", description="(Optional) Affidavit file name or path")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Certificate updated successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="update data successfully!."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=401, description="Unauthenticated"),
     *     @OA\Response(response=404, description="Certificate not found")
     * )
     */
    public function update(UpdateRequest $request)
    {

        $data = $this->additionalCertificateService->update($request->all());

        return $this->sendResponse($data, 'update data successfully!.');
    }

    /**
     * @OA\Delete(
     *     path="/api/additional/certificate/delete",
     *     tags={"AdditionalCertificate"},
     *     summary="Delete an Additional Certificate by ID",
     *     operationId="deleteAdditionalCertificate",
     *     security={{"sanctum":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *
     *         @OA\Schema(type="integer"),
     *         description="ID of the certificate to delete"
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Certificate deleted successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="delete data successfully"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(response=404, description="Certificate not found"),
     *     @OA\Response(response=500, description="Failed to delete data"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function delete(Request $request)
    {

        try {
            $data = $this->additionalCertificateService->delete($request->id);

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
