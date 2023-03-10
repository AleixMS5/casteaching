import './bootstrap';

import Alpine from 'alpinejs';
import casteaching_ams2 from '@ams092003/casteaching_ams2' ;
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";

import Status from "./components/Status.vue";

window.Alpine = Alpine;
window.casteaching=casteaching_ams2;
Alpine.start();


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
