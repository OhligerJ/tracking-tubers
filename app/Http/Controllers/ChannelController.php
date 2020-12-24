<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\ChannelInfo;
use App\Jobs\AddChannel;

class ChannelController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->url)){
            $channel = Channel::where('url', $url)->first();
        } else {
            $channel = Channel::all()->first();
        }

         $channel_info = ChannelInfo::where('channel_id', $channel->id)->orderBy('date', 'asc')->get();

         $info_array = [];

        foreach($channel_info as $key => $val){
            if ($key > 0){
                $sub_diff = $channel_info[$key]['subscriber_count'] - $channel_info[$key - 1]['subscriber_count'];
            } else {
                $sub_diff = $val['subscriber_count'];
            }

            if($sub_diff > 0 && $key > 0){
                $sub_diff = '+'.$sub_diff;
            }
            $info_array[] = [$val['date'], $sub_diff];           
        }

        return view('welcome', ['subscriber_info' => $info_array]);
    }
    public function dispatchAddChannel(Request $request)
    {
        $url = $this->cleanUrl($request->url);
        $title = $request->title ?? '';

        // AddChannel::dispatch($url, $title);
        dispatch(new AddChannel($url, $title));
    }

    public function allChannelInfo(Request $request)
    {
        // in case someone wants to use the GET method. Say, for testing, perhaps
        $url = $this->cleanUrl($request->url);
        
        $channel = Channel::where('url', $url)->first();
        
        $channel_info = ChannelInfo::where('channel_id', $channel->id)->orderBy('date', 'asc')->get();

        $info_array = [];

        foreach($channel_info as $key => $val){
            if ($key > 0){
                $sub_diff = $channel_info[$key]['subscriber_count'] - $channel_info[$key - 1]['subscriber_count'];
            } else {
                $sub_diff = $val['subscriber_count'];
            }

            if($sub_diff > 0 && $key > 0){
                $sub_diff = '+'.$sub_diff;
            }
            $info_array[] = [$val['date'], $sub_diff];           
        }
        // I was really hoping to make collection mapping work for this, but I never managed
        // $info = $channel_info->map(function ($item, $key) {     
        //     $prev_sub_count = $channel_info[$key - 1]->subscriber_count;       
        //     $sub_diff = $item['subscriber_count'] - $prev_sub_count;

        //     return [$item['date'] => $sub_diff, $item['subscriber_count'] => $item['subscriber_count']];
        // });

        return response()->json($info_array);
    }

    public function postNewChannel(Request $request)
    {
        $this->dispatchAddChannel($request);
    }

    public function cleanUrl($url){
        $url = "http://www.youtube.com/channel/" . $url; // We were doing this just for expediency of live testing. This would break the api if it posted a full URL, obviously
        $components = parse_url($url);

        // "/channel/UCDK9qD5DAQML-pzrtA7A4oA"
        if (isset($components['path']) && $components !== false && $components['path'] !== '/'){
            $url = "https://www.youtube.com". $components['path'];       
         } else {
            \Log::info($url . " was not a parseable URL");
            
            throw new \UnexpectedValueException('cleanUrl tried to parse an unparseable URL string');
         }
        // else {
        //     if(strpos($url, 'user') === false){ 
        //         //hinting at subscriber counts for users, not just channels. This logic is out of scope and would probably need to go deeper than this
                
        //         $url = "https://www.youtube.com/channel/" .$url;
        //     } else {
        //         $url = "https://www.youtube.com/user/" .$url;
        //     }
        // }
        \Log::info($url);
        return $url;
    }
}
