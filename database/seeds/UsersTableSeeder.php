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
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->assignRole('admin');
            $user->profile()->save(factory(App\Profile::class)->make());
        });   
        
        factory(App\User::class, 40)->create()->each(function ($user) {
            $user->assignRole('user');
            $user->profile()->save(factory(App\Profile::class)->make());
        });  

        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->assignRole('visiter');
            $user->profile()->save(factory(App\Profile::class)->make());
        });  
    }
}
