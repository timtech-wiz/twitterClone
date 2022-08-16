<template>
     <div class="flex w-full">
            <div class="mr-3">
                <user-avatar :url="tweet.user.avatar" />
                
            </div>
        <div class="flex-grow">
            <app-tweet-username :user="tweet.user"/>
                <app-tweet-body :tweet="tweet" />

                <app-tweet 
                class="border border-gray-700 rounded-lg"
                :tweet="tweet.original_tweet"
                />
             <app-tweet-action-group
             :tweet="tweet"
             />
            </div>
           
        </div>
</template>

<script>
export default {
    props:{
        tweet:{
            required:true,
            type:Object
        }    
    }
}
</script>