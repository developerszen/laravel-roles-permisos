<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = factory(User::class, 1)->create([
            'name' => 'Zen Technology',
            'email' => 'admin@zen-tech.com',
        ]);

        $user_writer = factory(User::class, 1)->create([
            'email' => 'writer@zen-tech.com',
        ]);
        $user_editor = factory(User::class, 1)->create([
            'email' => 'editor@zen-tech.com',
        ]);
    }
}
