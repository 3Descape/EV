require('./bootstrap');

/* global Vue*/
window.Vue = require('vue');

Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('roles', require('./components/Roles.vue'));
Vue.component('sites-edit', require('./components/SitesEdit.vue'));
Vue.component('site-edit', require('./components/SiteEdit.vue'));
Vue.component('event-edit', require('./components/EventEdit.vue'));
Vue.component('file-uploud', require('./components/FileUploud.vue'));
Vue.component('file-edit', require('./components/FileEdit.vue'));
Vue.component('image-library', require('./components/ImageLibrary.vue'));
Vue.component('personen-liste', require('./components/PeopleList.vue'));
Vue.component('update-person', require('./components/UpdatePerson.vue'));
Vue.component('create-person', require('./components/CreatePerson.vue'));
Vue.component('date-input', require('./components/DateInput.vue'));
Vue.component('event-resolve-conflict-list', require('./components/EventCategoryResolveConflictList.vue'));
// Vue.component('text-to-image', require('./components/TextToImage.vue'));
const app = new Vue({
    el: '#app',
});