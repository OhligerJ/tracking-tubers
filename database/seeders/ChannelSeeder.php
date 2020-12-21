<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->insert(array(
            array(
                'url' => 'https://www.youtube.com/channel/UCUT8RoNBTJvwW1iErP6-b-A',
                'title' => 'Disguised Toast',
            ),
            array(
                'url' => 'https://www.youtube.com/channel/UCddX-H9xUwQH6jOOHuL2vYw',
                'title' => 'Hafu',
            ),
            array(
                'url' => 'https://www.youtube.com/channel/UCFNTq9XKHDNy_1-2lL0kqCg',
                'title' => 'Corpse Husband',
            ),
            array(
                'url' => 'https://www.youtube.com/channel/UCWxlUwW9BgGISaakjGM37aw',
                'title' => 'Valkyrae',
            ),
          ));
    }
}
