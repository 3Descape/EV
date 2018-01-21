<template>
    <div class="col-lg-12">
        <div>
            <msg />
            <form @submit.prevent="uploud" ref="form">

                <div class="form-group">
                    <div class="d-flex">
                        <label for="name">Name:</label>
                        <p class="text-muted ml-1">(Optional)</p>
                    </div>

                    <input ref="name" v-model="userImage.name" type="text" id="name" class="form-control" name="name">
                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                        <ul class="m-0">
                            <li :key="error.name" v-for="error in errors.getError('name')">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file">Datei:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="file" @change="fileChange" multiple>
                        <label class="custom-file-label" for="customFile">
                            <i class="fa fa-upload" /> Bild hochladen..
                        </label>
                    </div>

                    <div class="progress mt-2" v-show="progress > -1">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="`width:${progress}%`" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                            {{ progress }}%
                        </div>
                    </div>

                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('file')">
                        <ul class="m-0">
                            <li :key="error.file" v-for="error in errors.getError('file')">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <button class="form-control btn btn-success" type="submit" v-show="!isLoading">
                        <i class="fa fa-plus" /> Hochladen
                    </button>
                    <div class="form-control btn btn-success" type="submit" v-show="isLoading">
                        <i class="fa fa-spinner fa-pulse" />
                    </div>
                </div>
            </form>
        </div>

        <div>
            <image-gallery :images-prop="imagesProp" />
        </div>
    </div>

</template>

<script>
/* global axios */
import Message from "./Message";
import ImageGallery from "./ImageGallery";
import { EventBus } from "./EventBus.js";
import Errors from "./Errors.js";

export default {
  components: {
    msg: Message,
    "image-gallery": ImageGallery
  },
  props: {
    imagesProp: {
      type: Array,
      required: true
    }
  },
  data: () => {
    return {
      errors: new Errors(),
      userImage: {
        name: "",
        image: {}
      },
      progress: -1,
      isLoading: false
    };
  },
  methods: {
    fileChange(e) {
      this.userImage.image = e.target.files[0];
    },
    reset() {
      this.userImage.name = "";
      this.userImage.image = {};
      this.$refs.name.focus();
      this.$refs.form.reset();
      this.progress = -1;
    },
    uploud() {
      let vue = this;
      vue.isLoading = true;
      let data = new FormData();
      data.append("name", this.userImage.name);
      data.append("file", this.userImage.image);

      let config = {
        onUploadProgress: function(progressEvent) {
          vue.progress = Math.round(
            progressEvent.loaded * 100 / progressEvent.total
          );
        }
      };

      this.errors.clearErrors();

      axios
        .post("/admin/bild", data, config)
        .then(msg => {
          EventBus.$emit("msg-event", msg.data.status);
          vue.reset();
          EventBus.$emit("image-added", msg.data.image);
          this.isLoading = false;
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data.errors);
          vue.reset();
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
          this.isLoading = false;
        });
    }
  }
};
</script>
