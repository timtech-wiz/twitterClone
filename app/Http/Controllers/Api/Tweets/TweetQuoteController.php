<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetRetweetUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetQuoteController extends Controller
{
    public function store(Tweet $tweet, Request $request){

       
        $retweet = $request->user()->tweets()->create([
            'type' => TweetType::QUOTE,
            'body' => $request->body,
            'original_tweet_id' => $tweet->id 
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast(new TweetRetweetUpdated($request->user(), $tweet));
    }
}
