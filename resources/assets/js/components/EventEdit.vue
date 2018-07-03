<template lang="html">
    <div>
        <msg />
        <h2 class="text-center">Bearbeiten</h2>
        <fieldset :disabled="isUpdating">
            <form class="form-group" @submit.prevent="update">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" v-model="event.name" class="form-control" id="name" required>
                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                        <ul class="m-0">
                            <li :key="error.name" v-for="error in errors.getError('name')">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Ort:</label>
                    <input type="text" v-model="event.location" class="form-control" id="location" required>
                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('location')">
                        <ul class="m-0">
                            <li :key="error.location" v-for="error in errors.getError('location')">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group" v-if="!isArchived">

                    <label for="date">Datum:</label>
                    <date-input :default="event.date" @date="syncDate"></date-input>
                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('date')">
                        <ul class="m-0">
                            <li :key="error.date" v-for="error in errors.getError('date')">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Beschreibung:</label>

                    <text-area :images-prop="imagesProp"
                            :markup-prop="event.markup"
                            @sync="sync">

                        <div slot-scope="{compiledMarkdown, inputEvents, inputAttrs}">
                            <textarea v-on="inputEvents"
                                    v-bind="inputAttrs"
                                    class="form-control"></textarea>

                            <div class="card mt-2">
                                <div class="card-header"
                                    role="tab">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse"
                                        :href="'#collapse' + event.id"
                                        aria-expanded="false"
                                        :aria-controls="'collapse' + event.id"
                                        class="text-dark">
                                            Vorschau
                                            <i class="fa fa-caret-down" />
                                        </a>
                                    </h5>
                                </div>

                                <div :id="'collapse' + event.id"
                                    class="collapse"
                                    role="tabpanel">
                                    <div class="card-body"
                                        v-html="compiledMarkdown" />
                                </div>
                            </div>
                        </div>
                    </text-area>

                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('markup')">
                        <ul class="m-0">
                            <li :key="error.markup" v-for="error in errors.getError('markup')">{{ error }}</li>
                        </ul>
                    </div>

                </div>

                <div class="form-group">
                    <label for="category">Kategorie:</label>
                    <select class="custom-select" v-model="event.event_category_id">
                        <option v-for="category in categories"
                                :value="category.id"
                                :key="category.id">
                            {{ category.name }}
                        </option>
                    </select>

                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('event_category_id')">
                        <ul class="m-0">
                            <li :key="error.event_category_id" v-for="error in errors.getError('event_category_id')">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-group d-flex">
                    <button class="btn btn-info ml-auto mr-2">
                        <i class="fa fa-pencil-alt" /> Speichern
                    </button>
                    <a :href="isArchived ? '/admin/veranstaltung/archiv' : '/admin/veranstaltung'" class="btn btn-light border border-dark">
                        <i class="fa fa-times" /> Zurück
                    </a>
                </div>
            </form>
        </fieldset>

        <div v-if="isArchived" class="mt-5">
            <hr>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" @change="fileChange" multiple accept="image/*">
                    <label class="custom-file-label" for="customFile">
                        <i class="fa fa-upload" /> Bilder hochladen..
                    </label>
                </div>

                <div class="progress mt-2" v-show="progress.length > 0">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="`width:${prog}%`" :aria-valuenow="prog" aria-valuemin="0" aria-valuemax="100">
                        {{ prog }}%
                    </div>
                </div>

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('file')">
                    <ul class="m-0">
                        <li :key="error.file" v-for="error in errors.getError('file')">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row" v-if="event.images.length">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-1" v-for="image in event.images" :key="image.id">
                    <div class="card h-100">
                        <div class="card-body row">
                            <div class="col-lg-4 col-sm-6">
                                <img :src="`/storage/${image.thump}`" class="img-fluid">
                            </div>
                            <div class="col-lg-8 col-sm-6 d-flex align-items-center">
                    
                                <p class="mb-0">Bild ID: {{ image.id }}</p>
                         
                                <form @submit.prevent="destroy(image)" class="ml-auto">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash-alt" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else>
                <p>Es gibt noch keine Bilder für diese Veranstaltung.</p>
            </div>
        </div>
    </div>
</template>

<script>
/* global axios */
import Errors from "./Errors.js";
import { EventBus } from "./EventBus.js";
import Message from "./Message.vue";
import TextArea from "./Textarea.vue";
import DateInput from "./DateInput.vue";

export default {
  components: {
    msg: Message,
    TextArea,
    DateInput
  },
  props: {
    eventProp: {
      type: Object,
      required: true
    },
    categories: {
      type: Array,
      required: true
    },
    imagesProp: {
      type: Array,
      required: false
    }
  },
  data() {
    return {
      event: this.eventProp,
      isArchived: false,
      isUpdating: false,
      errors: new Errors(),
      images: [],
      progress: [],
      imageErrors: []
    };
  },
  computed: {
    prog: function() {
      return Math.round(
        this.progress.reduce(function(a, b) {
          return a + b;
        }, 0) / this.images.length,
        0
      );
    }
  },
  created() {
    let now = new Date();
    let eventDate = new Date(this.event.date);
    this.isArchived = eventDate < now;
  },
  methods: {
    syncDate(date) {
      this.event.date = date;
    },
    update: function() {
      let vue = this;
      vue.isUpdating = true;
      axios
        .put(`/admin/veranstaltung/${vue.event.id}`, {
          name: vue.event.name,
          location: vue.event.location,
          date: this.event.date,
          markup: vue.event.markup,
          html: vue.event.html,
          event_category_id: vue.event.event_category_id
        })
        .then(msg => {
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data.errors);
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
      vue.isUpdating = false;
    },
    fileChange(e) {
      this.images = e.target.files;
      this.uploudImages();
    },
    postImage(data, index) {
      let vue = this;
      return new Promise(function(resolve, reject) {
        let config = {
          onUploadProgress: function(progressEvent) {
            vue.$set(
              vue.progress,
              index,
              Math.round(progressEvent.loaded * 100 / progressEvent.total)
            );
          }
        };
        axios
          .post(`/admin/veranstaltung/${vue.event.id}/bild`, data, config)
          .then(msg => {
            vue.event.images.push(msg.data.image);
            resolve();
          })
          .catch(errors => {
            reject(errors);
          });
      });
    },
    uploudImages: async function() {
      let vue = this;
      let jobs = [];
      for (var i = 0; i < vue.images.length; i++) {
        let data = new FormData();
        data.append("file", vue.images[i]);
        jobs.push(
          await this.postImage(data, i).catch(errors => {
            vue.errors.setErrors(errors.response.data.errors);
          })
        );
        vue.$forceUpdate();
      }

      Promise.all([jobs])
        .then(() => {
          if (vue.errors.length === 0) {
            EventBus.$emit("msg-event", "Bilder wurden hinzugefügt");
          }
          vue.progress = [];
          vue.images = [];
        })
        .catch(() => {
          console.log("error");
        });
    },
    destroy(image) {
      let vue = this;
      axios
        .delete(`/admin/bild/${image.id}`)
        .then(msg => {
          vue.event.images.splice(vue.event.images.indexOf(image), 1);
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
    sync(data) {
      this.event.markup = data.markup;
      this.event.html = data.html;
    }
  }
};
</script>
