<template>
    <div>
        <msg/>
        <form @submit.prevent="submit"
              ref="form">
            <div class="mb-3">
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
                        <li :key="error.name" v-for="error in errors.getError('name')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div class="mb-">
                <label for="body">Beschreibung:</label>
                <text-area v-model="file.markup" :images-prop="imagesProp"  :people-group-prop="peopleGroupProp"></text-area>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Datei:</label>

                <div class="mb-3">
                    <input type="file"
                           class="form-control"
                           id="customFile"
                           name="file"
                           @change="fileChange"
                           multiple>
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
                 class="mb-3">
                <p v-text="fileSize" />
            </div>

            <div class="mb-3">
                <button class="form-control btn btn-success"
                        type="submit">
                    <i class="fa fa-plus" /> Hinzufügen
                </button>
            </div>
        </form>

        <table class="table overflow">
            <col span="1" style="width: 80%;">
            <col span="1" style="width: 20%;">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="file in objects" :key="file.id">
                    <td>{{ file.name }}</td>
                    <td>
                        <div class="d-flex">
                            <a :href="route('file_edit', file.id)"
                               class="btn btn-warning ms-auto">
                                <i class="fa fa-pencil-alt" />
                            </a>

                            <form @submit.prevent="remove(file)">
                                <button type="submit" class="btn btn-danger mx-1">
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
    },
    peopleGroupProp: {
        required: true,
    }
  },
  data: () => {
    return {
      file: {
        name: "",
        markup: "",
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
    fileChange(e) {
      this.file.file = e.target.files[0];
    },
    submit() {
      let vue = this;
      let data = new FormData();
      data.append("name", this.file.name);
      data.append("markup", JSON.stringify(this.file.markup));
      data.append("file", this.file.file);

      let config = {
        onUploadProgress: function(progressEvent) {
          vue.uploud = Math.round(
            progressEvent.loaded * 100 / progressEvent.total
          );
        }
      };

      axios
        .post(route('file_store'), data, config)
        .then(msg => {
          vue.file.name = "";
          vue.file.markup = "";
          vue.file.file = {};
          vue.$refs.name.focus();
          vue.$refs.form.reset();
          vue.errors.clearErrors();
          vue.uploud = -1;
          vue.objects.push(msg.data.file);
          this.emitter.emit("msg-event", [ msg.data.status ]);
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data.errors);
          vue.uploud = -1;
          this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ] );
        });
    },
    remove(file) {
      axios
        .delete(route('file_destroy', file.id))
        .then(msg => {
          this.objects.splice(this.objects.indexOf(file), 1);
          this.emitter.emit("msg-event", [msg.data.status]);
        })
        .catch(() => {
          this.emitter.emit("msg-event", ["Es ist ein Fehler aufgetreten.", "danger"]);
        });
    }
  }
};
</script>
