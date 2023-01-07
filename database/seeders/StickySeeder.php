<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubForum;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StickySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subs = SubForum::all()->get();
        foreach ($subs as $sub) {
            DB::table('sticky_posts')->insert([
                'sub_forum_id' => $sub->id,
                'post_id' => $sub->posts->first()->id,
            ]);
        }
    }
}
