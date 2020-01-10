<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->assignRole('admin');
            $user->profile()->save(factory(App\Profile::class)->make());
        });

        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->assignRole('vip');
            $user->profile()->save(factory(App\Profile::class)->make());
        });

        factory(App\User::class, 20)->create()->each(function ($user) {
            $user->assignRole('user');
            $user->profile()->save(factory(App\Profile::class)->make());
        });
    }
}
