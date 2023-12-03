<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Options;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class OptionControllerTest extends TestCase
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
    
    public function test_option_update(): void
    {
        // Retrieve an existing question from the database
        $user = $this->authenticateUser();

        $question = Question::create([
            'title' => 'title',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $user->id,
            'active' => true
        ]);

        // Create an Options instance using the fetched question ID
        $options = Options::create([
            'title' => 'Original Title',
            'question_id' => $question->id,
            // Other fields...
        ]);
        $response = $this->post(route('options.update', [$options]), ['title' => 'Original Title',
        'question_id' => $question->id,]);

        $response->assertRedirect(route('options.index', ['question' => $question->id]));
    }

    public function test_option_edit(): void
    {
        $user = $this->authenticateUser();
        $question = Question::create(['title' => 'title',
        'description' => 'description',
        'start_at'=> '28.11.2023',
        'end_at'=> '29.11.2023',
        'user_id'=>$user->id,
        'active' =>true]);
        $options = Options::create([
            'title' => 'Original Title',
            'question_id' => $question->id,
        ]);
        $response = $this->get(route('questions.edit', [$options]));

        $response->assertStatus(200);
    }
    public function qustion_create()
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
        return $question;
    }
    public function test_option_create(): void
    {
        $question = $this->qustion_create();

        $user = $this->authenticateUser();

        $response = $this->get(route('options.create', ['question' => $question]));


        $response->assertStatus(200);
    }

    public function test_option_store(): void
    {
        $user = $this->authenticateUser();
        Storage::fake('images');

        $question = Question::create([
            'title' => 'title',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $user->id,
            'active' => true
        ]);

        $response = $this->post(route('options.store'), [
            'title' => 'Test Option',
            'question_id' => $question->id,
        ]);


        $response->assertRedirect(route('options.index', [$question]));

        $this->assertDatabaseHas('options', [
            'title' => 'Test Option',
            'question_id' => $question->id,
        ]);


    }

    public function test_option_index(): void
    {
        $this->authenticateUser();
        $question = Question::create([
            'title' => 'Test Question',
            'description' => 'description',
            'start_at' => '28.11.2023',
            'end_at' => '29.11.2023',
            'user_id' => $this->authenticateUser()->id,
            'active' => true
        ]);
        $response = $this->get(route('options.index', ['question' => $question->id]));

        $response->assertStatus(200);

        $response->assertViewIs('options.index');
    }
}
