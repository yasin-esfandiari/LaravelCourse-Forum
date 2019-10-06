<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $channel2 = ['title' => 'Vuejs', 'slug' => str_slug('Vuejs')];
        $channel3 = ['title' => 'CSS3', 'slug' => str_slug('CSS3')];
        $channel4 = ['title' => 'PHP Testing', 'slug' => str_slug('PHP Testing')];
        $channel5 = ['title' => 'Spark', 'slug' => str_slug('Spark')];
        $channel6 = ['title' => 'Lumen', 'slug' => str_slug('Lumen')];
        $channel7 = ['title' => 'Forge', 'slug' => str_slug('Forge')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
