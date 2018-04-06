require('./bootstrap');
/* global vue */
window.Vue = require('vue');
// import fontawesome from '@fortawesome/fontawesome';
// import solid from '@fortawesome/fontawesome-free-solid';
// import brands from '@fortawesome/fontawesome-free-brands';
// fontawesome.library.add(solid);
// fontawesome.library.add(brands);
Vue.component('personen-liste', require('./components/PeopleList.vue'));
const app = new Vue({
    el: '#app',
});