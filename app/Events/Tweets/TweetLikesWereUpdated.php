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


class TweetLikesWereUpdated implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $user;
    protected $tweet;

    public function __construct($user, $tweet)
    {
        $this->user = $user;
        $this->tweet = $tweet;
    }

    public function broadcastWith(){
        return [
            'id' => $this->tweet->id,
            'user_id' =>$this->user->id,
            'count' => $this->tweet->likes->count()
        ];
    }


    public function broadcastAs(){
        return 'TweetLikesWereUpdated';
    }

    public function broadcastOn()
    {
        return new Channel('tweets');
    }
}