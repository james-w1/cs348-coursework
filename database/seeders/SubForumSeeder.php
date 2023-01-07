<?php

namespace Database\Seeders;

use App\Models\SubForum;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubForum::factory()->count(10)
            ->has(Post::factory()->count(14)
                ->has(Reply::factory()->count(14))
            )->create();
    }
}
