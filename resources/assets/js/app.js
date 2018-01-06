require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');
//
// const app = new Vue({
//     el: '#vue',
// });

Vue.component('bild', require('./components/Image.vue'));

const app = new Vue({
    el: '#app',
});