<template>
    <div class="card-body">
        <fieldset class="mb-2"
                  :disabled="updating">
            <form class="mb-2"
                  @submit.prevent="update">

                <div class="d-flex mb-2">
                    <label for="title"
                           class="mr-auto">Titel:</label>

                    <button class="btn btn-danger ml-2"
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
                <text-area :images-prop="imagesProp"
                           :markup-prop="site.markup"
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
                                       :href="'#collapse' + site.id"
                                       aria-expanded="false"
                                       :aria-controls="'collapse' + site.id"
                                       class="text-dark">
                                        Vorschau
                                        <i class="fa fa-caret-down" />
                                    </a>
                                </h5>
                            </div>

                            <div :id="'collapse' + site.id"
                                 class="collapse markup-preview"
                                 role="tabpanel">
                                <div class="card-body"
                                     v-html="compiledMarkdown" />
                            </div>
                        </div>
                    </div>
                </text-area>

                <button class="btn btn-info form-control mt-2"
                        type="submit">
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
import { EventBus } from "./EventBus.js";

export default {
  props: {
    imagesProp: {
      type: Array,
      required: false
    },
    siteProp: {
      type: Object,
      required: true
    }
  },
  components: {
    TextArea
  },
  data() {
    return {
      updating: false,
      site: this.siteProp
    };
  },
  methods: {
    destroy() {
      this.$emit("destroy", this.site);

      let vue = this;
      axios
        .post(`/admin/seite/${vue.site.id}`, {
          _method: "delete"
        })
        .then(msg => {
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(() => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    update() {
      this.updating = true;
      let vue = this;
      axios
        .post(`/admin/seite/${vue.site.id}/update`, {
          title: vue.site.title,
          markup: vue.site.markup,
          html: vue.site.html
        })
        .then(response => {
          EventBus.$emit("msg-event", response.data.status);
          vue.updating = false;
        })
        .catch(error => {
          this.updating = false;
          EventBus.$emit("msg-event", error.response.data.errors, "danger");
        });
    },
    sync(data) {
      this.site.markup = data.markup;
      this.site.html = data.html;
    }
  }
};
</script>
