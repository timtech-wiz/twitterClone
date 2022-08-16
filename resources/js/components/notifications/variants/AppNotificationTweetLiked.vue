<template>
    <div class="p-4 flex-grow">
         <div class="text-gray-300">
            <app-tweet-username :user="notification.data.user" /> Liked your tweet
        </div>

         <p class="text-gray-600">
            {{notification.data.tweet.body}}
         </p>
    </div>
</template>

<script> 
export default {
    props:{
        notification:{
            required:true,
            type: Object
        }
    }
}
</script>