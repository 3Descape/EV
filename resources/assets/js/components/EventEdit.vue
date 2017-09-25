<template lang="html">
    <div class="">
        <h2 class="text-center">Bearbeiten</h2>
        <!-- action="{{route('admin_events_update', $event->id)}}{{request('type') && request('type') == 'archive' ? '?redirect=archived': ''}}" -->
        <fieldset :disabled="isUpdating">
            <form class="form-group" @submit.prevent="updateEvent">
                <div class="form-group row">
                    <div class="col-md-1">
                        Name:
                    </div>
                    <div class="col-md-11">
                        <input type="text" v-model="event.name" class="form-control" name="name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-1">
                        Ort:
                    </div>
                    <div class="col-md-11">
                        <input type="text" v-model="event.location" class="form-control" name="location" required>
                    </div>
                </div>

                <div class="form-group row" v-if="showDate">
                    <div class="col-md-1">
                        Datum:
                    </div>
                    <div class="col-md-11">
                        <input type="text" name="date" class="form-control" placeholder="dd.MM.yyyy HH:mm" v-model="event.date">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-1">
                        Beschreibung:
                    </div>
                    <div class="col-md-11">
                        <textarea type="text" v-model="event.markup" class="form-control" name="markup" required></textarea>

                        <div v-html="compiledMarkdown"></div>

                        <input type="text" hidden v-model="compiledMarkdown" name="markup">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-1">
                        Kategorie
                    </div>
                    <div class="col-md-11">
                        <select class="form-control" name="category" v-model="event.category_id">
                            <option v-for="category in categories" :value="category.id" :key="category.id" :selected="category.id == event.category.id">{{category.name}}</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-success" value="Aktualisieren">
            </form>
        </fieldset>
    </div>
</template>

<script>
import Markdown from './Markdown.vue';
function Errors() {
    let errors = {};
    setErrors: errors => {
        this.errors = errors
    }

    clearErrors: () => {
        this.errors = {}
    }

    hasError: (name) => {
        if(this.errors.indexOf(name)){
            return this.errors[name];
        }
        return {}
    }
}
export default {
    props: ['eventProp', 'categories'],
    data (){
        return{
            event: this.eventProp,
            isPast: false,
            showDate: true,
            isUpdating: false,
            errors: new Errors(),
        }
    },
    computed: {
        compiledMarkdown: function(){
            return this.event.markup ? marked(this.event.markup) : '';
        }
    },
    methods: {
        dateFormat: (value) => {
            return ('0'+(value.getDate()+1)).slice(-2) + '.' + ('0'+(value.getMonth()+1)).slice(-2) + '.' + value.getFullYear() + ' ' + ('0'+(value.getHours()+1)).slice(-2) + ':' + ('0'+(value.getMinutes()+1)).slice(-2);
        },
        updateEvent: function(){
            let vue = this;
            vue.isUpdating = true;
            axios.put('/admin/events/' + vue.event.id,{
                name: vue.event.name,
                location: vue.event.location,
                date: vue.event.date,
                markup: vue.event.markup,
                html: vue.compiledMarkdown,
                category: vue.event.category_id
            }).then((response)=>{
                vue.isUpdating = false;
                console.log(response.data.status)
            }).catch((errors)=>{
                this.errors.setErrors(errors)
                console.log(errors);
            })
        }
    },
    created(){
        marked.setOptions({
            gfm: true,
            breaks: true,
            tables: true,
        });

        let now = new Date();
        let eventDate = new Date(this.event.date);
        console.log(eventDate);
        console.log(now)
        this.showDate = eventDate > now;
        this.event.date = this.dateFormat(eventDate);
    }
}
</script>

<style lang="css">
</style>
