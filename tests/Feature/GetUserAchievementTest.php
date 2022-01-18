<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;

class GetUserAchievementTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_user_achievement()
    {
        $user = User::factory()->create();
        
        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200)
                 ->assertJson(fn (AssertableJson $json) =>
                 $json->hasall('unlocked_achievements', 'next_available_achievements', 'current_badge', 'next_badge', 'remaing_to_unlock_next_badge'));
    }
}
