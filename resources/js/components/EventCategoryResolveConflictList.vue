<template>
    <div>
        <msg/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Kategorie derzeit</th>
                    <th scope="col">Neue Kategorie</th>
                </tr>
            </thead>
            <tbody>
                <event-category-list-item v-for="event in events"
                                          :key="event.id"
                                          :event="event"
                                          :categories="categories"
                                          @updatedEvent="updatedEvent"></event-category-list-item>
            </tbody>
        </table>
    </div>
</template>

<script>
import { EventBus } from "./EventBus.js";
import Message from "./Message";
import EventCategoryListItem from "./EventCategoryListItem.vue";

export default {
  props: ["eventsProp", "categories"],
  components: {
    EventCategoryListItem,
    msg: Message
  },
  data: function() {
    return {
      events: this.eventsProp
    };
  },
  methods: {
    updatedEvent(event) {
      console.log("test");
      this.events.splice(this.events.indexOf(event), 1);
      EventBus.$emit("msg-event", "Kategorie geändert.");
    }
  }
};
</script>
