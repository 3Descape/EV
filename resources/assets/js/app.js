require('./bootstrap');
window.$ = window.jQuery = require('jquery');
/* global vue */
window.Vue = require('vue');
Vue.component('bild', require('./components/Image.vue'));

const app = new Vue({
    el: '#app',
});