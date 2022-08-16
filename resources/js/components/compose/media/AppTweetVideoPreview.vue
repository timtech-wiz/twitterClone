<template>
    <div class="mb-4 relative">
          <video controls preload :src="generateVideoPreview(video)" class="rounded-lg"></video>

        <a 
        href="#"
        @click.prevent="$emit('removed', video)"
        class="bg-gray-900 w-8 h-8 rounded-full absolute top-0 right-0 mt-3 mr-3 flex items-center justify-center"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-300 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</template>

<script>
export default {
    props:{
        video:{
        required:true,
        type:File
        }
        
    },

 
    methods:{
        generateVideoPreview(video){
            return URL.createObjectURL(video)
        },
    },
}
</script>