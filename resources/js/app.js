require('./bootstrap');

import Vue from 'vue'

//Main pages
import Channel from './views/channel.vue'

const app = new Vue({
    el: '#app',
    components: { Channel }
});