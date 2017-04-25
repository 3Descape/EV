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

var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote'],

  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'align': [] }],
  ['image', 'video'],

  ['clean']                                         // remove formatting button
];

var quill = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions
  },
  placeholder: 'Compose an epic...',
  theme: 'snow'  // or 'bubble'
});
