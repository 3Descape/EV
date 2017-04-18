require('./bootstrap');
window.Vue = require('vue');

Vue.component('parent', require('./components/Parent.vue'));

const app = new Vue({
  el: '#about',
  data:{
    num: 1,
    test: "hallo",
  },
  methods:{
    add: function(){
      this.num+=1
    },
  },
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
