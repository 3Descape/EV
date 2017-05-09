require('./bootstrap');
window.Vue = require('vue');

//Vue.component('parent', require('./components/Parent.vue'));

var app = new Vue({
  el: '#app',
  data:{
        events:[],
        errors:[],
        show_errors: false
    },
    methods:{
      getEvents(){
        self = this
        axios.get('/ev/admin/events/json').then(function(response){
          self.events = response.data;
          console.log("Got new Events");
        });
      },
      saveEvent(event){
        self = this
        axios.post('/ev/admin/events/store',{
          name: event.target.name.value,
          date: event.target.date.value,
          text: event.target.text.value,
          _token: event.target._token.value,
        }).then(function(response){
          self.getEvents()
          self.show_errors = false
        }).catch((failure) => {
          console.log(failure.response.data)
          self.errors = failure.response.data
          self.show_errors = true

        });
      },
      delete_event(id){
        axios({
          method: 'post',
          url: '/ev/admin/events/'+id+'/delete',
          data: {
            id: id
          }
        });
        console.log("Delete "+ id)
        this.getEvents()
      },
      edit_event(id){
        console.log("Edit "+id)
      }
    },
    mounted(){
      this.getEvents()
    }
});

CKEDITOR.replace( 'editor' );
CKEDITOR.stylesSet.add( 'bootstrap', [
    // Block-level styles.
    { name: 'H1', element: 'h1' },
    { name: 'H1', element: 'h1',attributes:{'class': 'text-center'} },
    { name: 'Text Wrapper', element: 'div', attributes:{'class': 'col-md-10 col-sm-12 mx-auto sizing'} },
    { name: 'Wrapper 12', element: 'div', attributes:{'class': 'col-md-12 mx-auto'} },
    { name: 'Red Title',  element: 'h3', styles: { color: 'Red' } },

    // Inline styles.
    { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
    { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
]);
