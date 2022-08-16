<template>
    <a href="#" class="flex text-center text-base" @click.prevent="likeUnlike">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 w-5 mr-2" v-if="!liked" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" v-else class="fill-current text-gray-600 w-5 mr-2" :class="{'text-red-600' :liked}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
         
        <span 
        class="text-gray-600"
        :class="{'text-red-600' :liked}"
        >{{tweet.like_count}}
        </span>
    </a>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    props:{
        tweet:{
            required:true,
            type:Object
        }    
    },

    computed:{
        ...mapGetters({
            likes:'likes/likes'
        }),

        liked(){
            return this.likes.includes(this.tweet.id)
        }
    },

    methods:{

        ...mapActions({
           likeTweet:'likes/likeTweet',
           unlikeTweet:'likes/unlikeTweet'
        }),
        likeUnlike(){
            if(this.liked){
                this.unlikeTweet(this.tweet)
                return
            }

            this.likeTweet(this.tweet)
        }
    }
}
</script>