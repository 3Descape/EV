<template>
    <div>
        <msg/>
        <form @submit.prevent="update" ref="form">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input ref="name" v-model="file.name" type="text" id="name" class="form-control" name="name">

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                    <ul class="m-0">
                        <li :key="error.name" v-for="error in errors.getError('name')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <label for="body">Beschreibung:</label>
            <text-area :images-prop="imagesProp"
                        :people-group-prop="peopleGroupProp"
                        v-model="file.markup">
            </text-area>

            <div class="mb-3 mt-4 d-flex">
                <button class="btn btn-warning me-2 ms-auto" type="submit" :disabled="updating">
                    <i v-show="!updating" class="fa fa-pencil-alt" />
                    <i v-show="updating" class="fa fa-spinner fa-pulse" /> Bearbeiten
                </button>

                <a :href="route('file_index')" class="btn btn-light border border-dark">
                    <i class="fa fa-times" /> Abbrechen
                </a>
            </div>
        </form>
    </div>
</template>


<script>
import Message from "./Message";
import Errors from "./Errors.js";
import TextArea from "./Textarea.vue";

export default {
  components: {
    msg: Message,
    TextArea
  },
  props: {
    fileProp: {
      type: Object,
      required: true,
    },
    imagesProp: {
      type: Array,
      required: true,
    },
    peopleGroupProp: {
        required: true,
    }
  },
  data() {
    return {
      file: this.fileProp,
      errors: new Errors(),
      updating: false
    };
  },
  methods: {
    update() {
      this.updating = true
      axios
        .put(route('file_update', this.file.id), {
          name: this.file.name,
          markup: this.file.markup,
        })
        .then(msg => {
          this.updating = false
          this.errors.clearErrors()
          this.emitter.emit("msg-event", [ msg.data.msg ])
        })
        .catch(errors => {
          this.updating = false
          this.errors.setErrors(errors.response.data.errors)
          this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
        })
    }
  }
};
</script>
