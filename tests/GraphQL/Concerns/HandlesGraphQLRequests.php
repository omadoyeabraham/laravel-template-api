<?php

namespace Tests\GraphQL\Concerns;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Passport;
use Laravel\Passport\ClientRepository;

use App\Models\User;
use Tests\GraphQL\Schema\AuthenticationQueriesAndMutations;

/**
 * Trait HandlesGraphQLRequests
 *
 * This trait contains various functions needed for GraphQL tests.
 *
 * @package Tests\GraphQL\Concerns
 */
trait HandlesGraphQLRequests
{
    /**
     * Install and configure Laravel passport for testing
     */
    public function setUpPassportClient()
    {
        Artisan::call("passport:install");
        Passport::loadKeysFrom(__DIR__ . '/../Storage/');
        $client = app(ClientRepository::class)->createPasswordGrantClient(null, 'test', 'http://localhost:9595');

        config()->set('lighthouse-graphql-passport.client_id', $client->id);
        config()->set('lighthouse-graphql-passport.client_secret', $client->secret);
    }

    /**
     * Create and login a test user.
     *
     * @return TestResponse
     */
    public function loginTestUser(): TestResponse
    {
        $this->setUpPassportClient();
        $user = factory(User::class)->create();

        $response = $this->postGraphQL([
            'query' => AuthenticationQueriesAndMutations::login(),
            'variables' => [
                'input' => [
                    'username' => $user->email,
                    'password' => 'password'
                ]
            ]
        ]);

        return $response;
    }

    /**
     * Create a test user, log them in, and return their login information.
     *
     * @return array
     */
    public function createLoginAndGetTestUserDetails(): array
    {
        $loginResponse = $this->loginTestUser();

        $accessToken = $loginResponse->json("data.login.access_token");
        $user = $loginResponse->json("data.login.user");

        return [
            'access_token' => $accessToken,
            'user' => $user
        ];
    }

    /**
     * Return authentication header for a GraphQL request
     *
     * @param string $accessToken
     * @return array
     */
    public function getGraphQLAuthHeader(string $accessToken): array
    {
        return ['Authorization' => "Bearer {$accessToken}"];
    }
}
