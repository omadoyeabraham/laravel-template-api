<?php

namespace Tests\GraphQL\Mutations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\GraphQL\Schema\AuthenticationQueriesAndMutations;
use Tests\TestCase;

use App\Models\User;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testItSuccessfullyRegistersANewUser()
    {
        $this->setUpPassportClient();

        $userData = collect(factory(User::class)->make())->except(['email_verified_at'])->toArray();
        $userData['password_confirmation'] = $userData['password'] = 'password';

        /** @var TestResponse $response */
        $response = $this->postGraphQL([
            'query' => AuthenticationQueriesAndMutations::register(),
            'variables' => [
                'input' => $userData
            ],
        ]);

        $response->assertJson([
            'data' => [
                'register' => [
                    'tokens' => [
                        'user' => [
                            'first_name' => $userData['first_name'],
                            'last_name' => $userData['last_name'],
                            'email' => $userData['email'],
                            'username' => $userData['username']
                        ]
                    ]
                ]
            ]
        ]);
    }

}
