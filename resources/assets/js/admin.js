require('./bootstrap');
window.Vue = require('vue');

//Vue.component('parent', require('./components/Parent.vue'));

var app = new Vue({
  el: '#textfield',
  data:{
    content: 'hallo',
    },
    methods:{
      saveContent(event){
        var cont = document.getElementById("richTextField");
        console.log(cont.innerHTML);
        axios.post('/ev/admin/about/menu_cont_update/' + event.target.id.value,{
          content: cont.innerHTML,
          _token: event.target._token.value,
        });
      },
    },
});
