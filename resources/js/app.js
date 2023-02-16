import './bootstrap';

import Alpine from 'alpinejs';
import casteaching from 'casteaching';
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";

window.Alpine = Alpine;
window.casteaching=casteaching;
window.Vue=Vue;
window.Vue.component('videos-list',"./components/VideosList.vue")
Alpine.start();


const app = new window.Vue({
    el: '#app',
});
