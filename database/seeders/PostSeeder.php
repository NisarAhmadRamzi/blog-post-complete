<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Post::create(['title'=>'book','sub_title'=>'importance of book in our socity','description'=>'by studying more books we can change our brain and our thinking style and discover new things about world','slug'=>Str::slug('demo'),'profile_id'=>'1']);
        Post::factory(20)->create();
    }
}
