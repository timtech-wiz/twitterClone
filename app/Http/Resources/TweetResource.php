<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'id' => $this->id,
            'body' => $this->body,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
            'parent_ids' => $this->parents()->pluck('id')->toArray(),
            'like_count' => $this->likes->count(),
            'retweet_count' => $this->retweet->count(),
            'replies_count' => $this->replies->count(),
            'media' => new MediaCollection($this->media),
            'entities' => new EntityCollection($this->entities),
            'original_tweet' => new TweetResource($this->originalTweet),
            'replying_to' => optional(optional($this->parentTweet)->user)->username,
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->timestamp,
            
         ];
    }
}
