This is the API for the five things app, i'll also later on use it as a base api for other
apps

## Laravel API Template Repository

This repository houses a template API built using Laravel, it was created to help me quickly to quickly bootstrap an API project.

Right now the repository has the following functionality

   - [*] API authentication using Laravel Passport.
   - [*] Authorization using spatie/laravel-permission.
   - [*] Activity logging using spatie/laravel-activitylog.
   - [*] GraphQL server using nuwave/lighthouse.
   - [*] A CI/CD pipeline using Github Actions.
   - [*] Automated tests for existing functionality.
    

### How to setup this repository

1. Clone the repository using the following command:

    ```bash
       git clone https://github.com/omadoyeabraham/laravel-templates.git
    ```
    
2. Configure the project using the following command:
     ```bash
       sh ./tools/configure.sh
     ```  
     The command does the following:
     * Installs composer dependencies
     * Creates a .env file with the content `APP_ENV=local`. 
     This will tell the app which environment the app will run
     * Creates a copies the contents from .env.example to .env.local
     * Generates the laravel app key using `php artisan key:generate`
        
3. Ensure that you fill the variables in `.env.local` with your credentials and values.    
    
4. Ensure you have docker installed and running.

5. Go through `docker-compose.yml` and change the default port numbers and database
    credentials as necessary.
    
7. If you changed the database and redis credentials/ports in `docker-compose.yml` ensure
    you change it in `.env.local` also. 
    
    Note that the ports in `.env.local` will be the ports exposed by docker
    e.g. if the postgres image has port credentials `"3434:5432"`, then use `3434` in the
    `.env.local` file.    
    
8. Spin up the app, postgresql and redis containers using the following command:
    ```bash
       docker-compose up
    ```
    
9. Run the script used to migrate and seed the database, and also install laravel passport.
    ```bash
       sh ./tools/prepare-local-database.sh
    ```

10. To setup AWS credentials to be used for serverless deployment from Github Actions CI/CD pipeline,
    the following secret variables have to be set on the Github repository
    * AwsAccessKeyId
    * AwsSecretAccessKey
    
11. Setup the environment variables in `serverless.yml` on AWS SSM so that serverless functions can use them.
