<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
	use RefreshDatabase;

	public function should_create_new_user_and_return()
	{
		$data = [
			'name' => 'vuesplash user',
			'email' => 'dummy@email.com',
			'password' => 'test1234',
			'password_confirmation' => 'test1234',
		];

		$response = $this->json('POST', route('register'), $data);

		$user = User::first();
		$this->assertEquals($data['name'], $user->name);

		$response
			->assertStatus(201)
			->assertJson(['name' => $user->name]);
	}
}
