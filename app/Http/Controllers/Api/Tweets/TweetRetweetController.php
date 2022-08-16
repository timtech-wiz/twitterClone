<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRetweetUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function store(Tweet $tweet, Request $request){

        // if($request->user()->hasRetweeted($tweet)){
        //     return response(null, 409);
        // }
        // $request->user()->retweet()->create([
        //     'tweet_id' => $tweet->id
        // ]);

        $retweet = $request->user()->tweets()->create([
            'type' => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id 
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast(new TweetRetweetUpdated($request->user(), $tweet));
    }

    public function destroy(Tweet $tweet, Request $request){

        broadcast(new TweetWasDeleted($tweet->retweetedTweet));
         $tweet->retweetedTweet()->where('user_id', $request->user()->id)->delete();
         broadcast(new TweetRetweetUpdated($request->user(), $tweet));
    }
}
