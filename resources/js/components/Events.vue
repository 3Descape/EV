<template lang="html">
    <msg />
    <event
        v-model="event"
        :errors="errors"
        :isArchived="isArchived"
        :isUpdating="isUpdating"
        :categories="categoriesProp"
        :save="save"
        :images-prop="imagesProp"
        :people-group-prop="peopleGroupProp"
        @reset-event="resetEvent()">

        <template #footer="data">
            <button type="submit" class="btn btn-success ms-auto">
                <i class="fa fa-plus"></i> Hinzufügen
            </button>
        </template>
    </event>

    <table class="table overflow">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col" class="d-none d-sm-table-cell">Datum</th>
                <th scope="col" class="d-none d-md-table-cell">Ort</th>
                <th scope="col" class="d-none d-md-table-cell">Kategorie</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
                <tr v-for="event in events" :key="event.id">
                    <td>{{event.name}}</td>
                    <td class="d-none d-sm-table-cell overflow-text">{{event.date.formatted_date}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{event.location}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{event.category.name}}</td>
                    <td>
                        <div class="d-flex">
                            <a :href="this.route('event_edit', event.id)" class="btn btn-warning ms-auto">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                            <form class="mx-1" @submit.prevent="deleteEvent(event)">
                                <button type="submit" class="btn btn-danger mx-1">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

        </tbody>
    </table>
</template>

<script>
/* global axios */
import Errors from "./Errors.js"
import Message from "./Message.vue"
import Event from "./Event.vue"

const default_event = {
        event_category_id: null,
        markup: null,
}

export default {
    components: {
        msg: Message,
        Event,
    },
    props: {
        eventsProp: {
            type: Array,
            required: true,
        },
        categoriesProp: {
            type: Array,
            required: true,
        },
        imagesProp: {
            type: Array,
            required: true,
        },
        peopleGroupProp: {
            required: true,
        },
    },
    data() {
        return {
            events: this.eventsProp,
            event: default_event,
            isArchived: false,
            isUpdating: false,
            errors: new Errors(),
        }
    },
    methods: {
        save() {
            this.isUpdating = true
            axios
            .post(route('event_store'), {
                name: this.event.name,
                date: this.event.date,
                location: this.event.location,
                markup: JSON.stringify(this.event.markup),
                event_category_id: this.event.event_category_id,
            })
            .then(msg => {
                this.emitter.emit("msg-event", [msg.data.msg])
                this.events.push(msg.data.event)
                this.event.name = ""
                this.event.location = ""
                this.event.markup = null
                this.event.event_category_id = null
            })
            .catch(errors => {
                console.log(errors)
                this.errors.setErrors(errors.response.data.errors);
                this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
            })
            this.isUpdating = false
        },
        deleteEvent(event) {
            axios
            .delete(route('event_destroy', event.id))
            .then(msg => {
                this.events.splice(this.events.indexOf(event), 1)
                this.emitter.emit("msg-event", [msg.data.status])
            })
            .catch(errors => {
                console.log(errors)
                this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
            })
        }
    }
}
</script>
