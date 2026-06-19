<?php

namespace Tests\Feature\Api;

use App\Models\Education;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EducationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_education_record_successfully()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
        $file = UploadedFile::fake()->create('degree.pdf', 100, 'application/pdf');
        $payload = [
            'user_id' => $user->id,
            'degree' => 'Bachelor',
            'degree_title' => 'BS Computer Science',
            'majors' => 'Software Engineering',
            'institute_name' => 'Virtual University',
            'board_name' => 'HEC',
            'start_date' => '2020-01-01',
            'end_date' => '2024-01-01',
            'obtained_marks' => 3200,
            'total_marks' => 4000,
            'obtained_percentage' => 80.00,
            'grade' => 'A',
            'foreign_qualified' => 'No',
            'education_document' => $file,
        ];

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/education/store', $payload);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'user_id',
                'degree',
                'education_document',
            ],
            'message',
        ]);
        $savedPath = str_replace('/storage/', '', $response['data']['education_document']);
        Storage::disk('public')->assertExists($savedPath);
    }

    public function test_user_can_fetch_education_records()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        Education::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);
        $response = $this->getJson('/api/education/index?user_id='.$user->id);
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            [
                'id',
                'user_id',
                'degree',
                'degree_title',
                'majors',
                'institute_name',
                'board_name',
                'start_date',
                'end_date',
                'obtained_marks',
                'total_marks',
                'obtained_percentage',
                'grade',
                'foreign_qualified',
                'education_document',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_user_can_update_education_record()
    {
        $user = User::factory()->create();
        $education = Education::factory()->create([
            'user_id' => $user->id,
            'degree' => 'Matric',
        ]);
        $this->actingAs($user, 'sanctum');
        $updateData = [
            'education_id' => $education->id,
            'user_id' => $user->id,
            'degree' => 'Intermediate',
            'degree_title' => 'FSc Pre-Engineering',
            'majors' => 'Physics, Chemistry, Math',
            'institute_name' => 'Govt. College',
            'board_name' => 'BISE',
            'start_date' => '2018-06-01',
            'end_date' => '2020-06-01',
            'obtained_marks' => 900,
            'total_marks' => 1100,
            'obtained_percentage' => 81.82,
            'grade' => 'A',
            'foreign_qualified' => 'No',
            'education_document' => null, // or a test value
        ];
        $response = $this->postJson('/api/education/update', $updateData);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Education update Successfully!.',
        ]);
        $this->assertDatabaseHas('educations', [
            'id' => $education->id,
            'degree' => 'Intermediate',
        ]);
    }

    public function test_user_can_delete_education_record()
    {
        $user = User::factory()->create();
        $education = Education::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user, 'sanctum');
        $response = $this->deleteJson('/api/education/delete', [
            'id' => $education->id,
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Education deleted successfully',
        ]);
        $this->assertDatabaseMissing('educations', [
            'id' => $education->id,
        ]);
    }
}
