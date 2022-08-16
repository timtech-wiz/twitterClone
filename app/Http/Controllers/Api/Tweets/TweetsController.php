<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\TweetFormRequest;
use App\Http\Resources\TweetCollection;
use App\Http\Resources\TweetResource;
use App\Notifications\Tweet\TweetMentioned;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetType;
use Illuminate\Http\Request;

class TweetsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:airlock'])->only(['store']);
    }

    public function show(Tweet $tweet){

        
        return new TweetCollection(collect([$tweet])->merge($tweet->parents()));
    }


    public function index(Request $request){

        $tweet = Tweet::with([
            'user', 
            'likes', 
            'retweet', 
            'replies',
            'media.baseMedia',
            'originalTweet.user', 
            'originalTweet.likes', 
            'originalTweet.retweet', 
            'originalTweet.media.baseMedia'
            ])->find(explode(',', $request->ids));
        return new TweetCollection($tweet);
    }

    public function store(TweetFormRequest $request){
        $tweet = $request->user()->tweets()->create(array_merge($request->only('body'), 
        ['type' => TweetType::TWEET]
    ));



    

    foreach($request->media as $id){
        $tweet->media()->save(TweetMedia::find($id));
    }

        foreach($tweet->mentions->users() as $user) 
        {
            if($request->user()->id !== $user->id){
                $user->notify(new TweetMentioned($request->user(), $tweet));
            }
            
        }
        
        broadcast(new TweetWasCreated($tweet));
    }
}
