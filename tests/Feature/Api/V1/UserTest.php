<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     *
     * @test
     */
    public function guest_can_display_user_list()
    {
        // Mockup users
        $users = User::factory(3)->create();

        // Tests
        $this->getJson(route('api.v1.users.index'))
            ->ray()
            ->assertStatus(200);

        ray("Test testy")->blue();
    }
}
