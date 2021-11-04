<?php

namespace Database\Seeders;

use App\Models\Task;
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

        User::factory(5)->create()->each(function (User $user)
        {
            Task::factory(5)->create(['user_id'=>$user->id]);
        });
    }
}
