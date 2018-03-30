require('./bootstrap');
window.$ = window.jQuery = require('jquery');
/* global vue */
window.Vue = require('vue');

Vue.component('PeopleList', require('./components/PeopleList.vue'));
const app = new Vue({
    el: '#app',
});