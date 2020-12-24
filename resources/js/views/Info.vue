<template>
  <div>
    Date: {{channel.date}}
    Subscriber Diff: {{channel.subscriber_diff}}
  </div>
</template>
<script>
const default_layout = "default";


export default {
    props: ['channel'],
  computed: {},
  data() {
      return {
          data: {
            'message':'Hello World', 
            'count': 0
        }
      }
  }
};
</script>