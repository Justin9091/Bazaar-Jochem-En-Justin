<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Make sure the roleseeder is already done
        $this->call(PropertiesSeeder::class);
        $this->call(RoleSeeder::class);

        $user = User::factory()->create();
        $this->createCustomer($user);
        $this->createReview($user);

        \App\Models\User::factory(10)->create();
        $individual = User::factory()->create([
            'name' => 'Test User',
            'email' => 'indi@gmail.com',
            'password' => bcrypt('password')
        ]);
        $individual->roles()->attach(1);

        $business = User::factory()->create([
            'name' => 'Test Business',
            'email' => 'buss@gmail.com',
            'password' => bcrypt('password')
        ]);
        $business->roles()->attach(2);

        $this->call(AdvertismentSeeder::class);
        $this->call(BidSeeder::class);
        $this->call(FavoriteSeeder::class);
    }
    private function createCustomer(User $user)
    {
        $user->customer()->create([
            'firstname' => $user->name,
            'lastname' => 'test',
            'city' => 'City',
            'streetname' => 'Street',
            'streetnumber' => 123,
        ]);
    }
    private function createReview(User $user)
    {
        $user->reviews()->create([
            'title' => 'testtitle',
            'description' => 'testdescription',
            'score' => 3,
            'reviewer' => 'reviewer naam',
            'date' => date('Y-m-d H:i:s')
        ]);
    }
}
