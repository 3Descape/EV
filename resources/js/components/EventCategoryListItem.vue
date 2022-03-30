<template>

    <tr>
        <td>{{event.name}}</td>
        <td class="">{{event.category.name}}</td>
        <td>
            <form class="ml-auto d-flex"
                  @submit.prevent="update(event)"
                  method="POST">
                <select class="custom-select mr-2"
                        v-model="new_category">
                    <option v-for="category in categories"
                            :key="category.id"
                            :value="category"> {{category.name}}
                    </option>
                </select>

                <button type="submit"
                        class="btn btn-info">
                    <div class="fa fa-sync-alt"
                         v-show="!updating"></div>
                    <div class="fa fa-spinner fa-pulse"
                         v-show="updating"></div>
                </button>
            </form>
        </td>
    </tr>
</template>

<script>
import { EventBus } from "./EventBus.js";
import Message from "./Message";
export default {
  props: ["event", "categories"],
  data() {
    return {
      new_category: {},
      updating: false
    };
  },
  mounted() {
    this.new_category = this.categories[0];
  },
  methods: {
    update(event) {
      this.updating = true;
      axios
        .put(`/admin/veranstaltung/${event.id}/konflikt`, {
          event_category_id: this.new_category.id
        })
        .then(msg => {
          this.$emit("updatedEvent", event);
          this.updating = false;
        })
        .catch(error => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    }
  }
};
</script>
