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
class LanguageControllerTest extends TestCase
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
   

    public function test_changeLanguage(): void
    {
        $response = $this->get('/change-language/en');
        
        $response->assertJson([
            'ok' => true,
            'language' => 'en',
        ])->assertStatus(200);
    }
}
