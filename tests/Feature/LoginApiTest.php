<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
	{
		parent::setUp();
		$this->user = factory(User::class)->create();
	}

	public function should_auth_user()
	{
		$response = $this->json('POST', route('login'), [
			'email' => $this->user->email,
			'password' => 'secret',
		]);

		$response
			->assertStatus(200)
			->assertJson(['name' => $this->user->name]);

		$this->assertAuthenticatedAs($this->user);
	}
}
