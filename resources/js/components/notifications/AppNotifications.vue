<template>
    <div>
        <app-notification 
        v-for="notification in notifications"
        :key="notification.index"
        :notification="notification"
        
        
        />
        
       <div
  v-if="notifications.length"
  v-observe-visibility="{
    callback: handleScrolledAtBottomofNotifications
  }"
  >

  </div>

    </div>
</template>

<script>
import axios from 'axios'
import { mapActions, mapGetters } from 'vuex';
 
export default {
   
    data(){
        return{
            page:1,
            lastPage:1
        }
    },

computed:{
  ...mapGetters({
    notifications:'notification/notification'
  }),

  urlWithPage(){
    return `/api/notifications?page=${this.page}`
  }
},

    methods:{
       ...mapActions({
        getNotifications: 'notification/getNotifications'
       }),


//        ...mapMutations({
//     PUSH_NOTIFICATION : 'timeline/PUSH_NOTIFICATION'
//   }),

  loadNotifications(){
    this.getNotifications(this.urlWithPage).then(response => {
      this.lastPage = response.data.meta.last_page
    }) 
  },

  handleScrolledAtBottomofNotifications(isVisible){
    if(!isVisible){
      return
    }

    if(this.lastPage === this.page){
      return
    }
    this.page++
    this.loadNotifications();
  }
    },

    mounted(){
        this.loadNotifications();
    }
}
</script>