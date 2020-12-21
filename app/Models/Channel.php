<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChannelInfo;

class Channel extends Model
{
    use HasFactory;

    protected $table = 'channels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'title',
    ];

    public function getSubscriberInfo()
    {
        $response = Http::get($this->url);

        if($response->status() >= 200 && $response->status() < 300){
            // normally, scan DOM for value (id = subscriber-count, and then parse it since "3.18M subscribers" isn't an integer)

            $channel_info = new ChannelInfo;
            $channel_info->channel_id = $this->id;
            $channel_info->date = Carbon::now();
            $channel_info->subscriber_count = rand(30000,3000000);

            $channel_info->save();
        }
    }
}
