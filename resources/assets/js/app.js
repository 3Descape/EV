require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

Vue.component('vue-people', require('./components/PeopleList.vue'));

const app = new Vue({
    el: '#app',
});
