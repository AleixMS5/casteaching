import './bootstrap';

import Alpine from 'alpinejs';
import casteaching from 'casteaching';
import vue from 'vue';
import VideosList from "./components/VideosList.vue";

window.Alpine = Alpine;
window.casteaching=casteaching;
window.vue=vue;
window.vue.component('videos-list',VideosList)
Alpine.start();
