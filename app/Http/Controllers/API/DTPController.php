<?php

namespace App\Http\Controllers\API;

use App\Models\DTP;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class DTPController extends BaseController
{
    /**
     * @OA\Schema(
     *     schema="DTP",
     *     type="object",
     *     title="DTP",
     *     required={"id", "user_id"},
     *
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="user_id", type="integer", example=5),
     *     @OA\Property(property="name", type="string", maxLength=50, nullable=true, example="AI Research"),
     *     @OA\Property(
     *         property="type",
     *         type="string",
     *         nullable=true,
     *         enum={"Articles", "Whitepapers", "Research", "Reports", "Journals", "Factsheets", "Newsletter", "Shareholders rights information"},
     *         example="Research"
     *     ),
     *     @OA\Property(property="link", type="string", format="url", nullable=true, example="https://example.com/resource.pdf"),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-06-11T12:00:00Z"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-06-11T14:30:00Z")
     * )
     */
    public function index(Request $request)
    {
        $data = DTP::all();

        return $data;
    }
}
