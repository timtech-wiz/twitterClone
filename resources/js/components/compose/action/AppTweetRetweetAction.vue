<template>
    
    <div>

         <app-dropdown v-if="!retweeted">

            <template v-slot:trigger>
                <app-tweet-retweet-action-btn :tweet="tweet"  />
            </template>
            <app-dropdown-item @click.prevent="reTweetOrUnreTweets" class="cursor-pointer">
                Retweet
            </app-dropdown-item>
            <app-dropdown-item @click.prevent="$modal.show(AppTweetRetweetModalVue, {tweet})" class="cursor-pointer">
                Quote
            </app-dropdown-item>
        </app-dropdown>

        <app-tweet-retweet-action-btn 
        :tweet="tweet"
        @click.prevent="reTweetOrUnreTweets" 
         v-else/>

    </div>
       
       
   
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import AppTweetRetweetModalVue from '../../modal/AppTweetRetweetModal.vue'
export default {
    props:{
        tweet:{
            required:true,
            type: Object
        }
    },

    data(){
        return{
            AppTweetRetweetModalVue
        }
    },
    computed:{
        ...mapGetters({
            retweet:'retweet/retweets'
        }),

         retweeted(){
            return this.retweet.includes(this.tweet.id)
        }
    },

    methods:{
        ...mapActions({
            retweetTweets: 'retweet/retweets',
            unRetweetTweets: 'retweet/unretweets'
        }),

        reTweetOrUnreTweets(){
            if(this.retweeted){
                this.unRetweetTweets(this.tweet)
                return;
            }

            this.retweetTweets(this.tweet)
        }
    }
       
    
}
</script>