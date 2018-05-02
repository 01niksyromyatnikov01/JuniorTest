<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{

    protected $comments = [];
    protected $user_name = [];

    public function init() {
        $this->comments = ["wow","cool","nice","perfect","great","здорово","прикольно"];
        $this->user_name = ["user","user1"];
    }

    public function run()
    {
        $this->init();
        for($i = 0;$i<sizeof($this->comments);$i++) {
            DB::table('comments')->insert([
                'article_id' => rand(1, 3),
                'user_name' => $this->user_name[rand(0, 1)],
                'text' => $this->comments[rand(0, sizeof($this->comments))],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);
        }
    }
}