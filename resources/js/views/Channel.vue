<template>
    <div class="entry">
      <info v-for="channel in subscriber_info" :key="channel.date" />
    </div>
</template>
<script>
import Info from './views/Info.vue';

const default_layout = "default";


export default {
  components: {
    'info':Info
    },
  props: [
      'subscriber_info'
  ],
  
};
</script>