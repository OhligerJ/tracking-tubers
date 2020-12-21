<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Channel;

class AddChannel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $url;
    public $title;

    /**
    * The number of seconds after which the job's unique lock will be released.
    *
    * @var int
    */
    public $uniqueFor = 3600; // Let's limit the number of jobs we add to the queue with the same URL, but let's not hold onto that information forever

    public function uniqueId()
    {
        return $this->url;
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $title = '')
    {
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $checkChannelExist = Channel::where('url', $this->url)->first();

        // Note that if we ever get multiple channels for some reason, we'll need to use $checkChannelExist->isEmpty() instead the current check. Current check is to be used when we are only getting one result from the above query
        if(is_null($checkChannelExist)){
            $channel = new Channel;

            $channel->url = $this->url;
            $channel->title = $this->title;
            $channel->save();
        }
    }
}
