<template>
 <div>
  <component 
    v-if="tweet"
    :is="`app-tweet-variant-${tweet.type}`"
    :tweet="tweet"
    class="mb-4"
   
    />
    <app-tweet-reply-compose 
    v-if="tweet"
    class="border-t-8 border-gray-800 p-4"
    :tweet="tweet"
    @success="$emit('close')"
    />
 </div>

</template>

<script>
export default {
   props:{
      tweet:{
         required:true,
         type: Object
      }
   }
}
</script>