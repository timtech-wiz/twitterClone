<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use Illuminate\Http\Request;

class TimelinesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:airlock']);
    }
    public function index(Request $request){
        $tweets = $request
        ->user()
        ->tweetsFromFollowing()
        ->parent()
        ->latest()
        ->with([
        'user', 
        'likes', 
        'retweet',
        'entities', 
        'replies',
        'media.baseMedia',
        'originalTweet.user', 
        'originalTweet.likes', 
        'originalTweet.retweet', 
        'originalTweet.media.baseMedia'
        ])->paginate(9);

        return new TweetCollection($tweets);
    }
}
