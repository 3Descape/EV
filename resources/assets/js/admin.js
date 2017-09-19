require('./bootstrap');

window.Vue = require('vue');

import Dashboard from './components/Dashboard.vue';
import Roles from './components/Roles.vue';

Vue.component('dashboard', Dashboard);
Vue.component('roles', Roles);

const app = new Vue({
    el: '#app',
});
