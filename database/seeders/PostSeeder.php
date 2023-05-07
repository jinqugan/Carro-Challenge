<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public $userNo = 0;
    public $totalUsers = 0;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $this->totalUsers = $users->count();
        $posts = \App\Models\Post::all()->toArray();
        $tags = \App\Models\Tag::factory(500)->create()->toArray();

        foreach (array_chunk($tags, 5) as $tagKey => $subtag) {
            $postId = $posts[$tagKey]['id'];

            foreach ($subtag as $key => $tag) {
                $postTags[] = [
                    'post_id' => $postId,
                    'tag_id' => $tag['id'],
                ];
            }
        }

        \App\Models\PostTag::insert($postTags);
    }

    public function getNextUser(): int
    {
        $userNo = $this->userNo;
        $totalUsers = $this->totalUsers;

        $this->userNo = ($userNo + 1) > ($totalUsers) ? 1 : $userNo + 1;

        return $this->userNo - 1;
    }
}
