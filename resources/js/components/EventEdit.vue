<template lang="html">
    <div class="card">
        <div class="card-body">
            <msg />
            <h2 class="text-center">Bearbeiten</h2>

            <event
                v-model="event"
                :errors="errors"
                :isArchived="isArchived"
                :isUpdating="isUpdating"
                :categories="categories"
                :save="update"
                :images-prop="imagesProp"
                :people-group-prop="peopleGroupProp">
                <template #footer="data">
                    <button class="btn btn-warning ms-auto me-2">
                        <i class="fa fa-pencil-alt" /> Speichern
                    </button>
                    <a :href="data.redirect" class="btn btn-light border border-dark">
                        <i class="fa fa-times" /> Abbrechen
                    </a>
                </template>
            </event>


            <div v-if="isArchived" class="mt-5">
                <hr>
                <div class="mb-3">
                    <div class="mb-3">
                        <input type="file" class="form-control" id="customFile" name="file" @change="fileChange" multiple accept="image/*">
                        <label class="form-label" for="customFile">
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

                <image-gallery :images-prop="event.images" v-if="event.images.length"></image-gallery>

                <div v-else>
                    <p>Es gibt noch keine Bilder für diese Veranstaltung.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/* global axios */
import Errors from "./Errors.js"
import Message from "./Message.vue"
import Event from "./Event.vue"
import ImageGallery from "./ImageGallery.vue"

export default {
  components: {
    msg: Message,
    Event,
    ImageGallery
  },
  props: {
    eventProp: {
      type: Object,
      required: true,
    },
    categories: {
      type: Array,
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
      event: this.eventProp,
      isArchived: false,
      isUpdating: false,
      errors: new Errors(),
      images: [],
      progress: [],
      imageErrors: [],
    };
  },
  computed: {
    prog: function() {
      return Math.round(
        this.progress.reduce(function(a, b) {
          return a + b;
        }, 0) / this.images.length,
        0)
    }
  },
  created() {
    let now = new Date()
    let eventDate = new Date(this.event.date)
    this.isArchived = eventDate < now
  },
  methods: {
    update() {
      this.isUpdating = true
      axios
        .put(route('event_update', this.event.id), {
          name: this.event.name,
          location: this.event.location,
          date: this.event.date,
          markup: this.event.markup,
          event_category_id: this.event.event_category_id,
        })
        .then(msg => {
          this.emitter.emit("msg-event", [msg.data.status])
        })
        .catch(errors => {
          console.log(errors)
          this.errors.setErrors(errors.response.data.errors);
          this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
        })
      this.isUpdating = false
    },
    fileChange(e) {
      this.images = e.target.files
      this.uploudImages()
    },
    uploudImages: async function() {
      let jobs = []
      for (var i = 0; i < this.images.length; i++)
      {
        let data = new FormData()
        data.append("file", this.images[i])
        jobs.push(await this.postImage(data, i))
      }

      Promise.all([jobs])
      .then(msg => {
        this.progress = []
        this.images = []
      })
    },
    postImage(data, index) {
      return new Promise(function(resolve, reject) {
        let config = {
          onUploadProgress: function(progressEvent) {
            this.progress[index] = Math.round(progressEvent.loaded * 100 / progressEvent.total)
          }.bind(this)
        }

        axios
          .post(route('event_image_store', this.event.id), data, config)
          .then(msg => {
            this.event.images.push(msg.data.image)
            this.emitter.emit("msg-event", [msg.data.status])
            resolve(msg)
          })
          .catch(errors => {
            reject(errors.response.data.errors)
          });
      }.bind(this)).catch(error => {
        this.emitter.emit("msg-event", [ error.file[0], "danger" ])
      })
    },
    destroy(image) {
      axios
        .delete(route('image_destroy', image.id))
        .then(msg => {
          this.event.images.splice(this.event.images.indexOf(image), 1)
          this.emitter.emit("msg-event", [msg.data.status])
        })
        .catch(error => {
            console.log(error)
            this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
        })
    },
  }
}
</script>
