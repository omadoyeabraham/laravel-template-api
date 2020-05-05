<?php

use Dotenv\Dotenv;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Default environment is "production"
|
| A distinct environment can be specified:
| You just need to have a ".env" file in the app's root folder,
| containing the environment name, and nothing else.
|
| The environment variables will always be read from ".env.environment" file.
| Example: for "staging" environment, the ".env.staging" file will be read.
|
 */

if (!function_exists('detectEnvironment')) {
    function detectEnvironment()
    {
        // Default environment is "production"
        $environment = 'production';
        // Get the full path for the ".env" file in the project's root
        $environmentPath = base_path() . '/.env';
        // Check if the ".env" file exists
        if (file_exists($environmentPath)) {
            // Get the trimmed ".env" file contents
            $env_contents = trim(file_get_contents($environmentPath));

            // Check if its testing
            if (env('APP_ENV') === 'testing'){
                $env_contents = 'testing';
            }

            // Check if there is a ".env.$env_contents" file
            if (!empty($env_contents) && file_exists(base_path("envs/$env_contents"))) {
                // A valid distinct environment has been specified
                $environment = $env_contents;
            }
        }
        // Set the environment variable called "ENV" with the name of the environment
        putenv('ENV=' . $environment);
        // Load the environment variables from the ".env.$environment" file
        Dotenv::createMutable(base_path("envs/$environment"))->load();
//        Dotenv::createMutable(base_path('envs/constants'))->load();
        // Returns the environment name
        return $environment;
    }
}
