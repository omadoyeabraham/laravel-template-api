<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

use App\Models\Enums\UserRoles;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedRegularUsers();
        $this->seedAdminUser();
    }

    /**
     * Seed admin users
     */
    private function seedAdminUser()
    {
        $faker = Faker::create();

        // Create the Admin user and assign the admin role
        $adminUser = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $adminUser->assignRole(UserRoles::ADMIN_USER);
    }

    /**
     * Seed regular users
     */
    private function seedRegularUsers()
    {
        foreach (range(1, 5) as $index) {
            $user = factory(User::class)->create([
                'first_name' => 'user',
                'last_name' => "{$index}",
                'email' => "user{$index}@users.com",
            ]);

            $user->assignRole(UserRoles::REGULAR_CUSTOMER);
        }
    }
}
