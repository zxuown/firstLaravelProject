<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vote;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class HomeControllerTest extends TestCase
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
    public function test_home_search(): void
    {
        $response = $this->get(route('home.search',[
        'models' => Question::all(),
        'votes' => Vote::all()]));

        $response->assertStatus(200);
       
    }

    public function test_the_application_returns_a_successful_response(): void
    {

        $response = $this->get(route('home.index', [
            'models' => Question::all(),
            'votes' => Vote::all(),
        ]));

        $response->assertStatus(200);
    }
}
