<template>
  <div>
    <form class="flex">
         
        <div class="mr-3 w-12 h-12">
            <user-avatar :url="$user.avatar" />
         </div>
       <!-- <span class="text-gray-600">{{media}}</span> -->
        <div class="flex-grow">
            <form @submit.prevent="submit">
                <app-tweet-compose-textarea v-model="form.body" message="what's Happening?"/>
                   
                <app-tweet-image-preview 
                :images="media.images" 
                v-if="media.images.length"
                  @removed="removeImg"
                />

                 <app-tweet-video-preview 
                :video="media.video" 
                v-if="media.video"
                @removed="closeVideo()"
                />
                <app-tweet-media-progress class="mb-4" 
                :progress="media.progress" v-if="media.progress"/>
                <div class="flex justify-between">
                    <ul class="flex items-center">
                        <li class="mr-4">
                            <app-tweet-compose-media-button 
                            id="media-compose" 
                            @selected="handleMedia"
                          
                            />
                        </li>
                        
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
                        >Tweet</button>
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
export default {
    mixins:[
        compose
    ],

    methods:{
        async post(){
            await axios.post('/api/tweets', this.form);
        }
    }
}
</script>

<style>

</style>