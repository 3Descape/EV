require('./bootstrap');

/* global Vue*/
window.Vue = require('vue');

Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('roles', require('./components/Roles.vue'));
Vue.component('sites-edit', require('./components/SitesEdit.vue'));
Vue.component('event-edit', require('./components/EventEdit.vue'));
Vue.component('file-uploud', require('./components/FileUploud.vue'));
Vue.component('image-library', require('./components/ImageLibrary.vue'));
Vue.component('personen-liste', require('./components/PeopleList.vue'));
Vue.component('person', require('./components/Person.vue'));

const app = new Vue({
    el: '#app',
});