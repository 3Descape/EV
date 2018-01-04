require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');
//
// const app = new Vue({
//     el: '#vue',
// });

Vue.component('test', require('./components/Test.vue'));

const app = new Vue({
    el: '#test',
});