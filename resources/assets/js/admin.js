require('./bootstrap');

/* global Vue*/
window.Vue = require('vue');

Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('roles', require('./components/Roles.vue'));
Vue.component('sites-edit', require('./components/SitesEdit.vue'));
Vue.component('event-edit', require('./components/EventEdit.vue'));
Vue.component('file-uploud', require('./components/FileUploud.vue'));
Vue.component('bild', require('./components/Image.vue'));
Vue.component('image-library', require('./components/ImageLibrary.vue'));
Vue.component('Person', require('./components/Person.vue'));
const app = new Vue({
    el: '#app',
});