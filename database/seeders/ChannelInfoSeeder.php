<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChannelInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 5; $i++){
            for($j = 1; $j <=31; $j++){
                DB::table('channel_info')->insert([
                    'channel_id' => $i,
                    'date' => Carbon::create(2020, 12, $j, 0),
                    'subscriber_count' => rand(30000,3000000),
                ]);
            }
        }
    }
}
