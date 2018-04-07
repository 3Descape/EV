require('./bootstrap');
/* global vue */

Vue.component('personen-liste', require('./components/PeopleList.vue'));
const app = new Vue({
    el: '#app',
});