<template>
    <div class="card-body">
        <fieldset class="mb-2" :disabled="updating">
            <form class="mb-2" @submit.prevent="update">
                <div class="d-flex mb-2">
                    <label for="title"
                           class="me-auto">Titel:</label>

                    <button class="btn btn-danger ms-2"
                            @click.prevent="destroy">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </div>
                <input type="text"
                       class="form-control mb-2"
                       placeholder="Titel"
                       v-model="site.title"
                       id="title">

                <label for="body">Text:</label>
                <text-area v-model="site.markup"
                            :images-prop="imagesProp"
                            :people-group-prop="peopleGroupProp">
                </text-area>

                <button class="btn btn-warning form-control mt-2" type="submit">
                    <div v-show="!updating">
                        <i class="fa fa-pencil-alt" /> Speichern
                    </div>
                    <i v-show="updating"
                       class="fa fa-spinner fa-pulse"
                       disabled />
                </button>
            </form>
        </fieldset>
    </div>
</template>

<script>
import TextArea from "./Textarea.vue";

export default {
  props: {
    imagesProp: {
      type: Array,
      required: true,
    },
    siteProp: {
      type: Object,
      required: true,
    },
    peopleGroupProp: {
        required: true,
    }
  },
  components: {
    TextArea,
  },
  data() {
    return {
      updating: false,
      site: this.siteProp,
    };
  },
  methods: {
    destroy() {
      this.$emit("siteDestroy", this.site)

      axios
        .delete(route('site_destroy', this.site.id))
        .then(msg => {
          this.emitter.emit("msg-event", [msg.data.status])
        })
        .catch(() => {
          this.emitter.emit("msg-event", ["Es ist ein Fehler aufgetreten.", "danger"])
        })
    },
    update() {
      this.updating = true
      axios
        .post(route('site_update', this.site.id), {
          title: this.site.title,
          markup: JSON.stringify(this.site.markup),
        })
        .then(response => {
          this.emitter.emit("msg-event", [response.data.status])
          this.updating = false
        })
        .catch(error => {
          this.updating = false
          this.emitter.emit("msg-event", [error.response.data.errors, "danger"])
        })
    },
  }
}
</script>
