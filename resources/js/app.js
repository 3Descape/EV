require('./bootstrap');
/* global vue */
let Vue = require('vue');

Vue.component('image-slider', require('./components/ImageSlider.vue'));
Vue.component('personen-liste', require('./components/PeopleList.vue'));
const app = new Vue({
    el: '#app',
});