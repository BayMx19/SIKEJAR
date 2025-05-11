<?php

namespace Tests\Unit;

use App\Models\FeedbackModel;
use App\Models\UsersModel;
use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $user = UsersModel::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
    }

    /** @test */
    public function it_displays_feedback_index_page()
    {
        FeedbackModel::factory()->create();

        $response = $this->get('/feedback');

        $response->assertStatus(200);
        $response->assertViewIs('feedback.index');
    }

    /** @test */
    public function it_displays_feedback_create_page()
    {
        $response = $this->get('/feedback/create');

        $response->assertStatus(200);
        $response->assertViewIs('feedback.create');
    }

    /** @test */
    public function it_displays_feedback_edit_page()
    {
        $feedback = FeedbackModel::factory()->create();

        $response = $this->get("/feedback/{$feedback->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('feedback.edit');
    }

    /** @test */
    public function it_updates_feedback()
    {
        $feedback = FeedbackModel::factory()->create([
            'komentar' => 'Old comment',
            'users_id' => UsersModel::factory()->create(['role' => 'User'])->id
        ]);

        $response = $this->put("/feedback/{$feedback->id}", [
            'komentar' => 'Updated comment',
            'users_id' => $feedback->users_id
        ]);

        $response->assertRedirect('/feedback');
        $this->assertDatabaseHas('feedback', [
            'id' => $feedback->id,
            'komentar' => 'Updated comment',
        ]);
    }

    /** @test */
    public function it_displays_feedback_detail_page()
{
    $feedback = FeedbackModel::factory()->create();

    $response = $this->get("/feedback/{$feedback->id}/detail");

    $response->assertStatus(200);
    $response->assertViewIs('feedback.detail');
}

    /** @test */
    public function it_deletes_feedback()
    {
        $feedback = FeedbackModel::factory()->create();

        $response = $this->delete("/feedback/{$feedback->id}");

        $response->assertRedirect('/feedback');
        $this->assertDatabaseMissing('feedback', [
            'id' => $feedback->id,
        ]);
    }

    /** @test */
    }