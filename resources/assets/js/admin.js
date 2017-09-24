require('./bootstrap');

window.Vue = require('vue');
window.marked = require('marked');

import Dashboard from './components/Dashboard.vue';
import Roles from './components/Roles.vue';
import SitesEdit from './components/SitesEdit.vue';

Vue.component('dashboard', Dashboard);
Vue.component('roles', Roles);
Vue.component('sites-edit', SitesEdit);

const app = new Vue({
    el: '#app',
});
