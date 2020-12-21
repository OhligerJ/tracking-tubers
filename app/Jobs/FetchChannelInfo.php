<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ChannelInfo;

class FetchChannelInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $channel->getSubscriberInfo();

        // NB: we use AllChannelInfo to call this job for each channel in order to allow great flexibility in the future. For example, we might end up separating jobs into different queues for the sake of load balancing. Or we might need to send each of these jobs out separately in order to not overload Youtube's request quota

        // It's also good design and good separation of concerns. This job just cares about fetching info for one channel. If something needs to change about that job, it can happen here. Any errors that occur for that one channel happen here, and don't bring the whole process to a halt; that just means this one job goes in the failed jobs queue
    }
}
