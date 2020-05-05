<?php

namespace App\Services;

use App\Events\NewCustomerRegistered;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\MustVerifyEmail;
use Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\BaseAuthResolver;

/**
 * Class AuthService
 *
 * This service is for authentication based functionality.
 *
 * @package App\Services
 */
class AuthService extends BaseAuthResolver
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register a new user.
     *
     * @param $attributes
     * @return array
     * @throws \Nuwave\Lighthouse\Exceptions\AuthenticationException
     */
    public function registerUser(array $attributes): array
    {
        $attributes = collect($attributes);

        $userData = $attributes->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'password'
        ])->toArray();

        $user = $this->userRepository->createUser($userData);

        if ($user instanceof MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
            event(new Registered($user));
            event(new NewCustomerRegistered($user));

            return [
                'tokens' => [],
                'status' => 'MUST_VERIFY_EMAIL',
            ];
        }

        $credentials = $this->buildCredentials([
            'username' => $attributes[config('lighthouse-graphql-passport.username')],
            'password' => $attributes['password'],
        ]);
        $user = User::where('username', $attributes['username'])->first();
        $response = $this->makeRequest($credentials);
        $response['user'] = $user;
        event(new Registered($user));

        return [
            'tokens' => $response,
            'status' => 'SUCCESS',
        ];
    }
}
