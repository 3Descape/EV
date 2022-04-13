require('./bootstrap')

import { createApp } from "vue"

import Dashboard from "./components/Dashboard.vue"
import Roles from "./components/Roles.vue"
import SitesEdit from "./components/SitesEdit.vue"
import SiteEdit from "./components/SiteEdit.vue"
import Events from "./components/Events.vue"
import EventEdit from "./components/EventEdit.vue"
import FileUploud from "./components/FileUploud.vue"
import FileEdit from "./components/FileEdit.vue"
import ImageLibrary from "./components/ImageLibrary.vue"
import PersonenListe from "./components/PeopleList.vue"
import UpdatePerson from "./components/UpdatePerson.vue"
import CreatePerson from "./components/CreatePerson.vue"
// import DateInput from "./components/DateInput.vue"
import EventResolveConflictList from "./components/EventCategoryResolveConflictList.vue"

import Person from "./components/Person.vue"

const app = createApp({
    components: {
        Dashboard,
        Roles,
        SitesEdit,
        SiteEdit,
        Events,
        EventEdit,
        FileUploud,
        FileEdit,
        ImageLibrary,
        PersonenListe,
        UpdatePerson,
        CreatePerson,
        EventResolveConflictList,
        Person,
    }
})

import mitt from 'mitt'
const emitter = mitt()
app.config.globalProperties.emitter = emitter
app.config.unwrapInjectedRef = true

import { ZiggyVue, Ziggy } from 'ziggy'
app.use(ZiggyVue, Ziggy)

app.mount("#app")