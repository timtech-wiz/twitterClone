<template>
  <div class="flex w-full border-b text-gray-800">
    <component 
    :is="`app-notification-${notification.type}`"
    :notification="notification"
    />
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
