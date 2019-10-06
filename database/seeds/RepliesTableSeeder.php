<?php

use Illuminate\Database\Seeder;
use App\Reply;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = [
            'user_id' => 1,
            'discussion_id' => 1,
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Nibh nisl condimentum id venenatis a condimentum. Eget aliquet nibh praesent tristique magna sit amet.'
        ];

        $r2 = [
            'user_id' => 1,
            'discussion_id' => 2,
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Nibh nisl condimentum id venenatis a condimentum. Eget aliquet nibh praesent tristique magna sit amet.'
        ];

        $r3 = [
            'user_id' => 2,
            'discussion_id' => 3,
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Nibh nisl condimentum id venenatis a condimentum. Eget aliquet nibh praesent tristique magna sit amet.'
        ];

        $r4 = [
            'user_id' => 2,
            'discussion_id' => 4,
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem dolor sed viverra ipsum nunc aliquet bibendum enim facilisis. Nibh nisl condimentum id venenatis a condimentum. Eget aliquet nibh praesent tristique magna sit amet.'
        ];

        Reply::create($r1);
        Reply::create($r2);
        Reply::create($r3);
        Reply::create($r4);
    }
}
