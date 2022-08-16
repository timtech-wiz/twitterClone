<template>
  <div>
    <form class="flex">
         
        <div class="mr-3 w-12 h-12">
            <user-avatar :url="$user.avatar" />
         </div>
       <!-- <span class="text-gray-600">{{media}}</span> -->
        <div class="flex-grow">
            <form @submit.prevent="submit">
                <app-tweet-compose-textarea 
                v-model="form.body" 
                message="Add a comment..."
                />
               
                <div class="flex justify-between">
                    <ul class="flex items-center">
                        
                        
                    </ul>
                    <div class="flex items-center justify-end">
                        <div>
                           <app-tweet-compose-limit 
                           :body="form.body"
                           class="mr-2" />
                        </div>
                        <button type="submit"
                        class="bg-blue-500 rounded-full font-bold 
                        leading-none
                         text-gray-300
                          text-center 
                          px-4
                          py-3
                          "
                        >Retweet</button>
                    </div>
                </div>
            </form>
        </div>
    </form>
  </div>
</template>

<script>
import compose from '../../mixins/compose'
import axios from 'axios';
import { mapActions } from 'vuex';
export default {
    mixins:[
        compose
    ],

    props:{
        tweet:{
            required:true,
            type: Object
        }
    },

    methods:{
        
        ...mapActions({
            quoteTweet: 'timeline/quoteTweet'
        }),
        async post(){
            await this.quoteTweet({
                tweet:this.tweet,
                data: this.form
            })

            this.$emit('success')
    }
}
}
</script>

<style>

</style>