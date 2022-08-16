<?php 

namespace App\Events\Tweets;

use App\Http\Resources\TweetResource;
use App\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class TweetRepliesWereUpdated implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    protected $tweet;

    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    public function broadcastWith(){
        return [
            'id' => $this->tweet->id,
            'count' => $this->tweet->replies->count()
        ];
    }


    public function broadcastAs(){
        return 'TweetRepliesUpdated';
    }

    public function broadcastOn()
    {
        return new Channel('tweets');
    }
}