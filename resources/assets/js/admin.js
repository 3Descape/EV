require('./bootstrap');
window.Vue = require('vue');

if(document.getElementById('events')){
    Vue.component('vue-datepicker', require('./components/DatePicker.vue'));
    date = new Date();
    month = ('0' + (date.getMonth() + 1)).slice(-2);
    day = ('0' + (date.getDate())).slice(-2);
    datestr = String(date.getFullYear()) + '-' + String(month) + '-' + String(day);

    const events = new Vue({
        el: '#events',
        data: {
            events: [],
            eventEdit: {},
            tempIndex: 0,
            errors: [],
            show_errors: false,

        },
        filters:{
            capitalize (value) {
                if (!value && value !== 0) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },
        methods: {
            addEvent(event) {
                var name = event.target.event_name;
                var description = event.target.event_description;
                var date = event.target.event_date;
                var location = event.target.event_location;
                var category = event.target.event_category;
                if (name.value.length > 4 && description.value.length > 9 && location.value.length > 5) {
                    this.events.push({
                        id: this.events.length + 1,
                        name: name.value,
                        description: description.value,
                        date: date.value,
                        location: location.value,
                        category: category.value,
                    });
                }

                vue = this;
                axios.post('/api/events', {
                    name: name.value,
                    description: description.value,
                    date: date.value,
                    location: location.value,
                    category: category.value,
                }).then(function() {
                    vue.show_errors = false;
                    vue.errors = [];
                    name.value = '';
                    name.focus();
                    location.value = '';
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
                axios.post('/api/events/' + id, {
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
                    location: event.target.location.value,
                    category: event.target.category.value
                };

                $('#myModal').modal('hide');

                _this = this;
                axios.post('/api/events/' + _this.eventEdit.id, {
                    id: vue.eventEdit.id,
                    name: event.target.name.value,
                    description: event.target.description.value,
                    date: event.target.event_date.value,
                    location: event.target.location.value,
                    category: event.target.category.value,
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
            axios.get('/api/events')
            .then(function(response) {
                vue.events = response.data;
            })
            .catch(function(error) {
                console.log(error);
            });

        }
    });
}

if(document.getElementById('role')){
    const roles = new Vue({
        el: '#role',
        data: {
            role_id: null,
        },
        methods: {
            modal(id){
                this.role_id = id;
                console.log(id);
                $('#permissionModal').modal('show');

            },
            addEvent(event) {
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
        },
    });
};
