require('./bootstrap');
import { createApp } from "vue";

// app.component('image-slider', require('./components/ImageSlider.vue'));
// app.component('personen-liste', require('./components/PeopleList.vue'));
// app.component('person', require('./components/Person.vue'));

import Person from './components/Person.vue'
import ImageSlider from './components/ImageSlider.vue'

const app = createApp({
    components: {
        Person,
        ImageSlider,
    }
});


app.mount("#app");