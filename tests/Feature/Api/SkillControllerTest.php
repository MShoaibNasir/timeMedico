<?php

namespace Tests\Feature\Api;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkillControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_fetch_skill_records()
    {
        $user = User::factory()->create();
        \App\Models\Skill::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);
        $this->actingAs($user, 'sanctum');
        $response = $this->getJson('/api/skill/index?user_id='.$user->id);
        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'user_id',
                'name',
                'skill_proficiency',
                'description',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_user_can_store_skill()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $data = [
            'user_id' => $user->id,
            'name' => 'Laravel Development',
            'skill_proficiency' => 'Expert',
            'description' => 'Expert in Laravel with 5 years of experience.',
        ];
        $response = $this->postJson('/api/skill/store', $data);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Skill Create Successfully!.',
        ]);
        $this->assertDatabaseHas('skills', [
            'user_id' => $user->id,
            'name' => 'Laravel Development',
            'skill_proficiency' => 'Expert',
        ]);
    }

    public function test_user_can_view_single_skill()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => 'JavaScript',
            'skill_proficiency' => 'Intermediate',
            'description' => '2 years of experience with JS.',
        ]);
        $response = $this->getJson('/api/skill/show?id='.$skill->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $skill->id,
            'user_id' => $user->id,
            'name' => 'JavaScript',
            'skill_proficiency' => 'Intermediate',
            'description' => '2 years of experience with JS.',
        ]);
    }

    public function test_user_can_update_skill_using_skill_id()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => 'Laravel',
            'skill_proficiency' => 'Intermediate',
            'description' => 'Good with Laravel basics.',
        ]);
        $updateData = [
            'skill_id' => $skill->id,
            'user_id' => $user->id,
            'name' => 'Laravel Framework',
            'skill_proficiency' => 'Expert',
            'description' => 'Now very skilled with Laravel.',
        ];
        $response = $this->postJson('/api/skill/update', $updateData);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Skill update Successfully!.',
        ]);
        $this->assertDatabaseHas('skills', [
            'id' => $skill->id,
            'name' => 'Laravel Framework',
            'skill_proficiency' => 'Expert',
            'description' => 'Now very skilled with Laravel.',
        ]);
    }

    public function test_user_can_delete_skill()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => 'React',
            'skill_proficiency' => 'Beginner',
            'description' => 'Learning React',
        ]);
        $response = $this->deleteJson('/api/skill/delete', [
            'id' => $skill->id,
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Skill deleted successfully',
        ]);
        $this->assertDatabaseMissing('skills', [
            'id' => $skill->id,
        ]);
    }
}
