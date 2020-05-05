<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

use Tests\GraphQL\Concerns\HandlesGraphQLRequests;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MakesGraphQLRequests, HandlesGraphqlRequests;
}
