<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRepliesWereUpdated;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use App\Notifications\Tweet\TweetReplyTo;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:airlock')->only(['store']);
    }

    public function show(Tweet $tweet){
        return new TweetCollection($tweet->replies);
    }


    public function store(Tweet $tweet, Request $request)
    {
        $reply = $request->user()->tweets()->create(array_merge(
            $request->only('body'),
            [
                'type' => TweetType::TWEET,
                'parent_id' => $tweet->id
            ]
         ) );

         foreach($request->media as $id){
            $tweet->media()->save(TweetMedia::find($id));
        }
        if($request->user()->id !== $tweet->user_id){
            $tweet->user->notify(new TweetReplyTo($request->user(), $reply));
        }
        broadcast(new TweetRepliesWereUpdated($tweet));
        
    }
}
