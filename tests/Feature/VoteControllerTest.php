<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use App\Models\Options;
use App\Models\Vote;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class VoteControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    public function test_vote_res(): void
    {
        $user = $this->authenticateUser();
        $question = Question::create([
            'title' => 'title',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $user->id,
            'active' => true
        ]);
        $option = Options::create([
            'title' => 'Original Title',
            'question_id' => $question->id,
           
        ]);
        $vote = Vote::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'option_id' => $option->id,
            'vote_at' => now(),
        ]);

        $response = $this->get(route('vote.res',[$question]));

        $response->assertStatus(200);
    }

    public function test_vote_store(): void
    {

        $user = $this->authenticateUser();
        $question = Question::create([
            'title' => 'title',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $user->id,
            'active' => true
        ]);
        $option = Options::create([
            'title' => 'Original Title',
            'question_id' => $question->id,
           
        ]);

       
        $this->actingAs($user);

      
        $response = $this->post(route('vote.store', [$question->id, $option->id]));

        
        $response->assertRedirect(route('home.index'));

        
        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'option_id' => $option->id,
        ]);

    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $this->authenticateUser();
        $user = $this->authenticateUser();
        $question = Question::create([
            'title' => 'title',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $user->id,
            'active' => true
        ]);
        $response = $this->get(route('vote.index', [
            'question' => $question,
            'models' => $question->options,

        ]));

        $response->assertStatus(200);
    }
}
