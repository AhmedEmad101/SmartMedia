<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostFeatureTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_create_a_post()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/posts', [
            'body' => 'Hello, world!',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['body' => 'Hello, world!']);

        $this->assertDatabaseHas('posts', ['body' => 'Hello, world!']);
    }

    /** @test */
    public function user_can_view_all_posts()
    {
        Post::factory()->count(3)->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/posts');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    /** @test */
    public function user_can_update_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/posts/{$post->id}", [
            'body' => 'Updated content',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['body' => 'Updated content']);

        $this->assertDatabaseHas('posts', ['body' => 'Updated content']);
    }

    /** @test */
    public function user_can_delete_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    /** @test */
    public function guest_cannot_create_post()
    {
        $response = $this->postJson('/api/posts', [
            'body' => 'Unauthenticated post',
        ]);

        $response->assertStatus(401);
    }
}
