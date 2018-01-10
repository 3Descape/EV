<template>
    <div class="col-lg-12">
        <div>
            <msg></msg>
            <form @submit.prevent="uploud" ref="form">

                <div class="form-group row">
                    <div class="col-lg-2 col-md-3 col-sm-12 d-flex">
                        <label for="name">Name:</label>
                        <p class="text-muted ml-1">(Optional)</p>
                    </div>

                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <input ref="name" v-model="userImage.name" type="text" id="name" class="form-control" name="name" >
                        <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                            <ul class="m-0">
                                <li  v-bind:key="error.name" v-for="error in errors.getError('name')">{{error}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <label for="file">Datei:</label>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <label class="custom-file" style="width: 100%;">
                            <input type="file" id="file" class="custom-file-input" name="file" @change="fileChange" >
                            <span class="custom-file-control">
                                <i class="fa fa-upload"></i> Datei hochladen..
                            </span>
                        </label>

                        <div class="progress mt-2" v-show="progress > -1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="`width:${progress}%`" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                {{progress}}%
                            </div>
                        </div>

                        <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('file')">

                            <ul class="m-0">
                                <li v-bind:key="error.file" v-for="error in errors.getError('file')">{{error}}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-2 col-md-3 col-sm-12"></div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <button class="form-control btn btn-success" type="submit">
                            <i class="fa fa-plus"></i> Hochladen
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            
            <image-gallery :images-prop="imagesProp"></image-gallery>

        </div>
    </div>
    
</template>

<script>
import Message from "./Message";
import ImageGallery from "./ImageGallery";
import { EventBus } from "./EventBus.js";
import Errors from "./Errors.js";

export default {
  props: ["images-prop"],
  data: () => {
    return {
      errors: new Errors(),
      userImage: {
        name: "",
        image: {}
      },
      progress: -1
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
        .post("/admin/bilder", data, config)
        .then(msg => {
          EventBus.$emit("msg-event", msg.data.status);
          vue.reset();
          EventBus.$emit("image-added", msg.data.image);
        })
        .catch(errors => {
          vue.errors.setErrors(errors.response.data);
          vue.reset();
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    isJSON(str) {
      try {
        return JSON.parse(str) && !!str;
      } catch (e) {
        return false;
      }
    }
  },
  components: {
    msg: Message,
    "image-gallery": ImageGallery
  }
};
</script>
