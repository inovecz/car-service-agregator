import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { createApp } from 'vue/dist/vue.esm-bundler.js';

import 'bootstrap-icons/font/bootstrap-icons.css';

import SearchComponent from './components/SearchComponent.vue';


const app = createApp({});

app.component('SearchComponent', SearchComponent);

const mountedApp = app.mount('#app');