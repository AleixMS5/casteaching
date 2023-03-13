import './bootstrap';

import Alpine from 'alpinejs';
import casteaching from '@acacha/casteaching' ;
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";
const baseUrl = import.meta.env.VITE_API_URL;
import Status from "./components/Status.vue";
const options = {baseUrl: baseUrl};
const api = casteaching(options);
console.log('options:');
console.log(options);
window.Alpine = Alpine;
window.casteaching=api;
Alpine.start();
console.log("hola")
console.log(baseUrl)
const vueApp = document.querySelector('#app')

if(vueApp){

    window.Vue = Vue
    window.Vue.component('videos-list', VideosList )
    window.Vue.component('video-form', VideoForm )
    window.Vue.component('status', Status )
    // window.Vue.component('video-form', VideoForm )
    // window.Vue.component('status', Status )

    const app = new window.Vue({
        el: '#vueapp',
    });
}
