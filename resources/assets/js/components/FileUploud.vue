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

            <div class="form-group">
                <label for="description">Beschreibung:</label>
                <input v-model="file.description"
                       class="form-control"
                       type="text"
                       id="description"
                       name="description">

                <div class="alert alert-danger mt-2"
                     role="alert"
                     v-if="errors.hasError('description')">
                    <ul class="m-0">
                        <li :key="error.description"
                            v-for="error in errors.getError('description')">{{ error }}</li>
                    </ul>
                </div>
            </div>

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
                    <td class="overflow-text d-none d-md-table-cell">{{ file.description }}</td>

                    <td>
                        <div class="d-flex">
                            <a :href="`/admin/datei/edit/${file.id}`"
                               class="btn btn-warning ml-auto">
                                <i class="fa fa-edit" />
                            </a>

                            <form @submit.prevent="remove(file)">
                                <button type="submit"
                                        class="btn btn-danger mx-1">
                                    <i class="fa fa-trash" />
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

export default {
  components: {
    msg: Message
  },
  props: {
    files: {
      type: Array,
      required: true
    }
  },
  data: () => {
    return {
      file: {
        name: "",
        description: "",
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
      data.append("description", this.file.description);
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
          vue.file.description = "";
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
