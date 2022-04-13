require('./bootstrap');
import { createApp } from "vue";

// app.component('image-slider', require('./components/ImageSlider.vue'));
// app.component('personen-liste', require('./components/PeopleList.vue'));
// app.component('person', require('./components/Person.vue'));

import Person from './components/Person.vue'

const app = createApp({
    components: {
        Person,
    }
});


app.mount("#app");