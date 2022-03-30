<template>
    <div>
        <msg/>
        <form @submit.prevent="submit"
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

            <div class="form-group">
                <label for="file">Datei:</label>

                <div class="custom-file">
                    <input type="file"
                           class="custom-file-input"
                           id="customFile"
                           name="file"
                           @change="fileChange"
                           multiple>
                    <label class="custom-file-label"
                           for="customFile">
                        <i class="fa fa-upload" /> Datei hochladen..
                    </label>
                </div>

                <div class="progress mt-2"
                     v-show="uploud > -1">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                         role="progressbar"
                         :style="width"
                         :aria-valuenow="uploud"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        {{ uploud }}%
                    </div>
                </div>

                <div class="alert alert-danger mt-2"
                     role="alert"
                     v-if="errors.hasError('file')">
                    <ul class="m-0">
                        <li :key="error.file"
                            v-for="error in errors.getError('file')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div v-show="fileSize"
                 class="form-group">
                <p v-text="fileSize" />
            </div>

            <div class="form-group">
                <button class="form-control btn btn-success"
                        type="submit">
                    <i class="fa fa-plus" /> Hinzufügen
                </button>
            </div>
        </form>

        <table class="table overflow">
            <col span="1"
                 style="width: 25%;">
            <col span="1"
                 style="width: 65%;">
            <col span="1"
                 style="width: 10%;">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col"
                        class="d-none d-md-table-cell">Beschreibung</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in objects"
                    :key="file.id">
                    <td>{{ file.name }}</td>
                    <td class="overflow-text d-none d-md-table-cell">{{ file.markup }}</td>

                    <td>
                        <div class="d-flex">
                            <a :href="`/admin/datei/edit/${file.id}`"
                               class="btn btn-warning ml-auto">
                                <i class="fa fa-pencil-alt" />
                            </a>

                            <form @submit.prevent="remove(file)">
                                <button type="submit"
                                        class="btn btn-danger mx-1">
                                    <i class="fa fa-trash-alt" />
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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
    files: {
      type: Array,
      required: true
    },
    imagesProp: {
      type: Array,
      required: true
    }
  },
  data: () => {
    return {
      file: {
        name: "",
        markup: "",
        html: "",
        file: {}
      },
      errors: new Errors(),
      uploud: -1,
      objects: {}
    };
  },
  computed: {
    fileSize: function() {
      if (this.file.file.size) {
        return (
          Math.round(this.file.file.size / (1024 * 1024) * 100, 3) / 100 + "MB"
        );
      }
      return "";
    },
    width() {
      return "width:" + this.uploud + "%";
    }
  },
  created: function() {
    this.objects = this.files;
  },
  methods: {
    sync(data) {
      this.file.markup = data.markup;
      this.file.html = data.html;
    },
    fileChange(e) {
      this.file.file = e.target.files[0];
    },
    submit() {
      let vue = this;
      let data = new FormData();
      data.append("name", this.file.name);
      data.append("html", this.file.html);
      data.append("markup", this.file.markup);
      data.append("file", this.file.file);

      let config = {
        onUploadProgress: function(progressEvent) {
          vue.uploud = Math.round(
            progressEvent.loaded * 100 / progressEvent.total
          );
        }
      };

      axios
        .post("/admin/datei", data, config)
        .then(msg => {
          vue.file.name = "";
          vue.file.markup = "";
          vue.file.file = {};
          vue.$refs.name.focus();
          vue.$refs.form.reset();
          vue.errors.clearErrors();
          vue.uploud = -1;
          vue.objects.push(msg.data.file);
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data.errors);
          vue.uploud = -1;
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    remove(file) {
      let vue = this;
      axios
        .delete(`/admin/datei/${file.id}`)
        .then(msg => {
          vue.objects.splice(vue.objects.indexOf(file), 1);
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(() => {
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
