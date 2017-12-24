require('./bootstrap');

window.Vue = require('vue');
window.marked = require('marked');

import Dashboard from './components/Dashboard.vue';
import Roles from './components/Roles.vue';
import SitesEdit from './components/SitesEdit.vue';
import EventEdit from './components/EventEdit.vue';
// import FileUploud from './components/FileUploud'

Vue.component('dashboard', Dashboard);
Vue.component('roles', Roles);
Vue.component('sites-edit', SitesEdit);
Vue.component('event-edit', EventEdit);
Vue.component('file-uploud', require('./components/FileUploud.vue'));
// Vue.component('msg', require('./components/Message.vue'));
const app = new Vue({
    el: '#app',
});
