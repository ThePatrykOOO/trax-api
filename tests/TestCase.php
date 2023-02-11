<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public User $user;

    public function login()
    {
        $this->user = User::factory()->create();
        Passport::actingAs($this->user);
    }

}
