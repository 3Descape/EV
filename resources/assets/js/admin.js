require('./bootstrap');
window.Vue = require('vue');

Vue.component('vue-datepicker', require('./components/DatePicker.vue'));
date = new Date();
datestr = String(date.getFullYear())+'-'+String(date.getMonth())+'-'+String(date.getDate());
const app = new Vue({
  el: "#events",
  data:{
    events:[],
    eventEdit: {},
    tempIndex: 0,
    errors: [],
    show_errors: false,
  },
  methods:{
    addEvent(event){
      var name = event.target.event_name;
      var description = event.target.event_description;
      var date = event.target.event_date;

      this.events.push({id: this.events.length+1, name: name.value, description: description.value, date: date.value});
      vue = this;
      axios.post('/ev/api/events', {
        name: name.value,
        description: description.value,
        date: date.value,
      }).then(function(){
        vue.show_errors = false;
        vue.errors = [];
        name.value = '';
        name.focus();
        description.value = '';
        date.value = datestr;
      })
      .catch(function (error) {
        vue.errors = error.response.data;
        vue.show_errors = true;
      });
    },
    deleteEvent(id, index){
      this.events.splice(index, 1);
      vue = this;
      axios.post('/ev/api/events/' + id, {
        id: id,
        _method: 'delete',
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    editEvent(index){
      this.eventEdit = this.events[index];
      this.eventEdit['starttime'] = {'time': this.eventEdit.date}

      this.tempIndex = index;
      $('#myModal').modal('show');
    },
    updateEvent(event){
      console.log(this.events[this.tempIndex])
      this.events[this.tempIndex] = {id: this.eventEdit.id, name: event.target.name.value, description: event.target.description.value, date: event.target.date.value};
      $('#myModal').modal('hide');

      vue = this;
      axios.post('/ev/api/events/' + vue.eventEdit.id, {
        id: vue.eventEdit.id,
        name: event.target.name.value,
        description: event.target.description.value,
        date: event.target.date.value,
        _method: 'put',
      })
      .catch(function (error) {
        console.log(error);
      });
      this.eventEdit = [];
    }
  },

  created: function (){
    vue = this;
    axios.get('/ev/api/events')
    .then(function (response) {
      vue.events = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });

  }
});
