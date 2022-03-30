<template>
    <div>
        <msg/>
        <form @submit.prevent="update"
              ref="form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input ref="name"
                       v-model="file.name"
                       type="text"
                       id="name"
                       class="form-control"
                       name="name">

                <div class="alert alert-danger mt-2"
                     role="alert"
                     v-if="errors.hasError('name')">
                    <ul class="m-0">
                        <li :key="error.name"
                            v-for="error in errors.getError('name')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <label for="body">Beschreibung:</label>
            <text-area :images-prop="imagesProp"
                       :markup-prop="file.markup"
                       @sync="sync">

                <div slot-scope="{compiledMarkdown, inputEvents, inputAttrs}">
                    <textarea v-on="inputEvents"
                              v-bind="inputAttrs"
                              class="form-control"
                              id="body"></textarea>

                    <div class="card mt-2">
                        <div class="card-header"
                             role="tab">
                            <h5 class="mb-0">
                                <a data-toggle="collapse"
                                   href="#collapse"
                                   aria-expanded="false"
                                   aria-controls="collapse"
                                   class="text-dark">
                                    Vorschau
                                    <i class="fa fa-caret-down" />
                                </a>
                            </h5>
                        </div>

                        <div id="collapse"
                             class="collapse markup-preview"
                             role="tabpanel">
                            <div class="card-body"
                                 v-html="compiledMarkdown" />
                        </div>
                    </div>
                </div>
            </text-area>

            <div class="form-group mt-4 d-flex">
                <button class="btn btn-info mr-2 ml-auto"
                        type="submit"
                        :disabled="updating">
                    <i v-show="!updating"
                       class="fa fa-pencil-alt" />
                    <i v-show="updating"
                       class="fa fa-spinner fa-pulse" /> Bearbeiten
                </button>

                <a href="/admin/datei"
                   class="btn btn-light border border-dark">
                    <i class="fa fa-times" /> Abbrechen
                </a>
            </div>
        </form>
    </div>
</template>


<script>
/* global axios*/
import Message from "./Message";
import { EventBus } from "./EventBus.js";
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
      required: true
    },
    imagesProp: {
      type: Array,
      required: true
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
    sync(data) {
      this.file.markup = data.markup;
      this.file.html = data.html;
    },
    update() {
      this.updating = true;
      axios
        .put(`/admin/datei/${this.file.id}`, {
          name: this.file.name,
          markup: this.file.markup,
          html: this.file.html
        })
        .then(msg => {
          this.updating = false;
          this.errors.clearErrors();
          EventBus.$emit("msg-event", msg.data.msg);
        })
        .catch(errors => {
          this.updating = false;
          this.errors.setErrors(errors.response.data.errors);
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
