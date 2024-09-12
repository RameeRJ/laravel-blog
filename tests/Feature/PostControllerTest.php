<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_add_post_with_title_content_and_image()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('create'), [
            'title' => 'Test Post',
            'post_text' => 'This is the content of the post.',
            'image' => UploadedFile::fake()->image('post-image.jpg'),
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('message', 'Your post was created successfully!');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'post_text' => 'This is the content of the post.',
            'poststatus' => 'active',
            'user_id' => $user->id,
            'username' => $user->name,
        ]);

        // Storage::disk('public')->assertExists('postimage/' . Post::first()->image);
    }

    /** @test */
    public function test_user_can_add_post_without_image()
{
    $user = User::factory()->create();  // Create a test user
    $this->actingAs($user);             // Authenticate the user

    // Simulate a POST request to the create route
    $response = $this->post(route('create'), [
        'title' => 'Post Without Image',    // Valid title
        'post_text' => 'Content without image.',  // Valid post content
    ]);

    // Assert that the user is redirected to the home route after post creation
    $response->assertRedirect('/home'); // Use the relative URL directly

    // Assert that the session has the success message
    $response->assertSessionHas('message', 'Your post was created successfully!');

    // Check that the post was added to the database with the correct values
    $this->assertDatabaseHas('posts', [
        'title' => 'Post Without Image',   // Title is correctly saved
        'post_text' => 'Content without image.',  // Post content is saved
        'user_id' => $user->id,            // The correct user is associated with the post
        'poststatus' => 'active',          // Default post status is 'active'
        'image' => null,                   // Image should be null since no image was uploaded
    ]);
}


    /** @test */
    public function user_can_edit_post()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->put(route('update', $post->id), [
        'title' => 'Updated Post Title',
        'post_text' => 'Updated post content.',
    ]);

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('message', 'Your post was updated successfully!');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post Title',
        'post_text' => 'Updated post content.',
    ]);
}
    /** @test */
    public function user_can_delete_post()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->delete(route('destroy', $post->id));

    // Verify redirection and session message
    $response->assertRedirect();
    $response->assertSessionHas('message', 'Your post was delete successfully!');

    // Check if the post is no longer in the database
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
}

    /** @test */
    public function user_can_view_single_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get(route('show', $post->id));

        $response->assertOk();
        $response->assertViewIs('post.show');
        $response->assertViewHas('post', $post);
    }

    /** @test */
    public function adding_post_fails_when_title_is_missing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('create'), [
            'post_text' => 'This post has no title.',
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function adding_post_fails_when_content_is_missing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('create'), [
            'title' => 'Title but no content',
        ]);

        $response->assertSessionHasErrors('post_text');
    }


    /**
     * Test that an authenticated user can create a post.
     */
    public function test_authenticated_user_can_create_post()
    {
        // Create a user instance
        $user = User::factory()->create();

        // Act as the authenticated user and post valid data
        $response = $this->actingAs($user)->post(route('create'), [
            'title' => 'Sample Post Title',
            'post_text' => 'This is a sample post.',
        ]);

        // Check if the post was created successfully
        $response->assertRedirect(route('home'))
                 ->assertSessionHas('message', 'Your post was created successfully!');

        // Ensure the post exists in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Sample Post Title',
            'post_text' => 'This is a sample post.',
            'user_id' => $user->id,
        ]);
    }

    public function test_index_redirects_unauthenticated_users()
    {
        $response = $this->get(route('mypost'));

        $response->assertRedirect(route('login'));
    }

    
    public function test_index_shows_posts_for_authenticated_users()
    {
        $user = User::factory()->create();

        Post::factory()->create([
            'username' => $user->name,
        ]);

        $response = $this->actingAs($user)->get(route('mypost'));

        $response->assertStatus(200);

        $response->assertViewHas('posts', function ($posts) use ($user) {
            return $posts->first()->username === $user->name;
        });
    }

}
