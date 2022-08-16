<template>
    <div class="w-12 h-12">
      <img :src="url" class="w-12 rounded-full" alt=""> 
    </div>
    
</template>

<script>
export default {
    props:['url']
}
</script>