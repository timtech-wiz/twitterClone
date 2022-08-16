<template>
    <a :href="`/hashtag/${body}`" class="text-blue-600">{{body}}</a>
</template>

<script>
export default {
    props:{
        body:{
            required:false,
            type:String
        }
    }
}
</script>