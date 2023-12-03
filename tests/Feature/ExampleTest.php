<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class ExampleTest extends TestCase
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
    public function test_question_update(): void
    {
        
        $user = $this->authenticateUser();
        $question = Question::create(['title' => 'title',
        'description' => 'description',
        'start_at'=> '28.11.2023',
        'end_at'=> '29.11.2023',
        'user_id'=> $user->id,
        'active' =>true]);
        $response = $this->post(route('questions.update', [$question]), ['title' => 'title',
        'description' => 'description',
        'start_at'=> '28.11.2023',
        'end_at'=> '29.11.2023',
       
        'active' =>true]);

        $response->assertRedirect(route('questions.index'));
    }
    public function test_question_edit(): void
    {
        $user = $this->authenticateUser();
        $question = Question::create(['title' => 'title',
        'description' => 'description',
        'start_at'=> '28.11.2023',
        'end_at'=> '29.11.2023',
        'user_id'=>$user->id,
        'active' =>true]);
        $response = $this->get(route('questions.edit', [$question]));

        $response->assertStatus(200);
    }
    public function test_question_create(): void
    {
        $this->authenticateUser();
        $response = $this->get(route('questions.create'));

        $response->assertStatus(200);
    }
    public function test_question_store(): void
    {
        
        Storage::fake('public');

        $user = $this->authenticateUser();

        $file = UploadedFile::fake()->image('test_image.jpg');

        $response = $this->post(route('questions.store'), [
            'title' => 'New Question',
            'description' => 'New Description',
            'start_at' => now(),
            'end_at' => now()->addDays(2),
            'image' => $file,
            'active' => true,
        ]);

        $response->assertRedirect(route('questions.index'));

        /**
         * @var Question $question
         */
        $question = Question::query()->first();
        $this->assertEquals('New Question', $question->title);
        $this->assertEquals('New Description', $question->description);
        $this->assertTrue($question->active);

    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $this->authenticateUser();
        $response = $this->get(route('questions.index'));

        $response->assertStatus(200);
    }
}
