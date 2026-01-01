<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_access_profile_edit_page()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertViewIs('profile.edit');
    }

    /** @test */
    public function user_can_update_profile_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'admin']);
        $file = UploadedFile::fake()->image('profile.jpg');

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'profile_photo' => $file,
        ]);

        $response->assertRedirect();
        $user->refresh();

        $this->assertNotNull($user->profile_photo);
        Storage::disk('public')->assertExists($user->profile_photo);
    }

    /** @test */
    public function profile_photo_is_displayed_on_dashboard()
    {
        $user = User::factory()->create(['role' => 'admin', 'profile_photo' => 'profiles/test.jpg']);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('storage/profiles/test.jpg');
    }
}
