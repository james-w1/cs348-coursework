<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\IsFriendsWith;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IsFriendsWithSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IsFriendsWith::factory()->count(100)->create();
    }
}
