require('./bootstrap');
window.Vue = require('vue');

Vue.component('vue-datepicker', require('./components/DatePicker.vue'));
date = new Date();
month = ('0' + (date.getMonth() + 1)).slice(-2);
day = ('0' + (date.getDate())).slice(-2);
datestr = String(date.getFullYear()) + '-' + String(month) + '-' + String(day);
console.log(datestr);

const app = new Vue({
    el: '#events',
    data: {
        events: [],
        eventEdit: {},
        tempIndex: 0,
        errors: [],
        show_errors: false,

      },
    methods: {
        addEvent(event) {
          var name = event.target.event_name;
          var description = event.target.event_description;
          var date = event.target.event_date;
          var location = event.target.event_location;
          if (name.value.length > 4 && description.value.length > 9 && location.value.length > 5) {
            this.events.push({
                id: this.events.length + 1,
                name: name.value,
                description: description.value,
                date: date.value,
                location: location.value
              });
          }

          vue = this;
          axios.post('/ev/api/events', {
                  name: name.value,
                  description: description.value,
                  date: date.value,
                  location: location.value,
                }).then(function() {
                  vue.show_errors = false;
                  vue.errors = [];
                  name.value = '';
                  name.focus();
                  description.value = '';
                  date.value = datestr;
                })
              .catch(function(error) {
                  vue.errors = error.response.data.errors;
                  vue.show_errors = true;
                });
        },
        deleteEvent(id, index) {
          this.events.splice(index, 1);
          vue = this;
          axios.post('/ev/api/events/' + id, {
                  id: id,
                  _method: 'delete',
                })
              .catch(function(error) {
                  console.log(error);
                });
        },

        editEvent(index) {
          this.eventEdit = this.events[index];
          this.eventEdit['starttime'] = {
              'time': this.eventEdit.date
            };

          this.tempIndex = index;
          $('#myModal').modal('show');
        },

        updateEvent(event) {

          this.events[this.tempIndex] = {
              id: this.eventEdit.id,
              name: event.target.name.value,
              description: event.target.description.value,
              date: event.target.event_date.value,
              location: event.target.location.value
            };

          $('#myModal').modal('hide');

          _this = this;
          axios.post('/ev/api/events/' + _this.eventEdit.id, {
                  id: vue.eventEdit.id,
                  name: event.target.name.value,
                  description: event.target.description.value,
                  date: event.target.event_date.value,
                  location: event.target.location.value,
                  _method: 'put',
                })
              .catch(function(error) {
                  console.log(error);
                });

          this.eventEdit = [];
        },
      },

    created: function() {
        vue = this;
        axios.get('/ev/api/events')
            .then(function(response) {
                vue.events = response.data;
              })
            .catch(function(error) {
                console.log(error);
              });

      }
  });
