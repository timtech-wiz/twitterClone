import axios from 'axios'
export default {

    data(){
        return{
            form:{
                body:'',
                media:[]
            },

            media:{
                images:[],
                video:'',
                progress: 0
            },

            mediaType:{}
        }
    },

    methods:{
        async submit(){

            if(this.media.images.length || this.media.video){
                let media = await this.uploadMedia()
                this.form.media = media.data.data.map(r => r.id)
            }
         

            // console.log(this.form)
            await this.post()
            this.form.body = ''
            this.form.media = []
            this.media.images = []
            this.media.video = null
            this.media.progress = 0
        },

        handleUploadProgress(event){
            this.media.progress = parseInt(Math.round((event.loaded/event.total) * 100))
        },

        async uploadMedia(){
            return await axios.post('/api/media', this.buildMediaForm(), {
                headers:{
                    'Content-type' : 'multipart/form-data'
                },
                onUploadProgress: this.handleUploadProgress
            })
        },

        buildMediaForm(){
            let form = new FormData();

            if(this.media.images.length){
                this.media.images.forEach((image, index)=>{
                    form.append(`media[${index}]`, image)
                })
            }

            if(this.media.video){
               form.append('media[0]', this.media.video)
            }

            return form
        },

          async getMediaTypes(){
            let response = await axios.get('/api/media/types');
            this.mediaType = response.data.data
        },

        closeVideo(video){
            this.media.video = ''
            return;
        },

        removeImg(image){
           this.media.images = this.media.images.filter((i) =>{
            return image !== i
           })
        },

        handleMedia(files){
            Array.from(files).slice(0, 4).forEach((file) =>{
                if(this.mediaType.image.includes(file.type)){
                    this.media.images.push(file)
                }

                 if(this.mediaType.video.includes(file.type)){
                    this.media.video = file
                }

            })

            if(this.media.video){
                this.media.image = []
            }
        },
      
    },

      mounted(){
            this.getMediaTypes()
        }
}