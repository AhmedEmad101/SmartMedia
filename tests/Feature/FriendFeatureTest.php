<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FriendFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_send_friend_request()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $response = $this->actingAs($sender, 'sanctum')
            ->postJson('/api/friends/send-request', [
                'receiver_id' => $receiver->id,
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('friend_requests', [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);
    }

    /** @test */
    public function user_cannot_send_duplicate_friend_request()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        FriendRequest::factory()->create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);

        $response = $this->actingAs($sender, 'sanctum')
            ->postJson('/api/friends/send-request', [
                'receiver_id' => $receiver->id,
            ]);

        $response->assertStatus(409); // conflict
    }

    /** @test */
    public function user_can_delete_friend_request()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $request = FriendRequest::factory()->create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);

        $response = $this->actingAs($sender, 'sanctum')
            ->deleteJson('/api/friends/delete-request', [
                'request_id' => $request->id,
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('friend_requests', [
            'id' => $request->id,
        ]);
    }

    /** @test */
    public function user_can_accept_friend_request()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $request = FriendRequest::factory()->create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
        ]);

        $response = $this->actingAs($receiver, 'sanctum')
            ->postJson('/api/friends/add', [
                'request_id' => $request->id,
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('friends', [
            'user_id' => $sender->id,
            'friend_id' => $receiver->id,
        ]);

        $this->assertDatabaseMissing('friend_requests', [
            'id' => $request->id,
        ]);
    }

    /** @test */
    public function user_can_delete_a_friend()
    {
        $user = User::factory()->create();
        $friend = User::factory()->create();

        $friendRelation = Friend::factory()->create([
            'user_id' => $user->id,
            'friend_id' => $friend->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson("/api/friends/{$friendRelation->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('friends', [
            'id' => $friendRelation->id,
        ]);
    }

    /** @test */
    public function guest_cannot_send_friend_request()
    {
        $receiver = User::factory()->create();

        $response = $this->postJson('/api/friends/send-request', [
            'receiver_id' => $receiver->id,
        ]);

        $response->assertStatus(401);
    }
}
