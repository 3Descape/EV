<template>
    <div class="col-lg-10 col-md-12 mx-auto">
        <form @submit.prevent="update">
            <fieldset :disabled="working">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           v-model="person.name">

                    <div class="alert alert-danger mt-2"
                         role="alert"
                         v-if="errors.hasError('name')">
                        <ul class="m-0">
                            <li :key="error.name"
                                v-for="error in errors.getError('name')">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>

                <label for="body">Beschreibung:</label>
                <text-area :images-prop="imagesProp"
                           :markup-prop="person.markup"
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
                                       :href="'#collapse' + person.id"
                                       aria-expanded="false"
                                       :aria-controls="'collapse' + person.id"
                                       class="text-dark">
                                        Vorschau
                                        <i class="fa fa-caret-down" />
                                    </a>
                                </h5>
                            </div>

                            <div :id="'collapse' + person.id"
                                 class="collapse markup-preview"
                                 role="tabpanel">
                                <div class="card-body"
                                     v-html="compiledMarkdown" />
                            </div>
                        </div>
                    </div>
                </text-area>

                <div class="form-group">
                    <label for="category">Kategorie</label>
                    <select name="people_category_id"
                            v-model="person.category"
                            class="custom-select"
                            id="category">
                        <option v-for="category in categories"
                                :key="category.id"
                                :value="category"> {{category.name | ucfirst}}
                        </option>
                    </select>
                    <div class="alert alert-danger mt-2"
                         role="alert"
                         v-if="errors.hasError('people_category_id')">
                        <ul class="m-0">
                            <li :key="error.people_category_id"
                                v-for="error in errors.getError('people_category_id')">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-group"
                     v-if="person.category.has_image">
                    <label for="image">Bild:</label>
                    <div class="row">

                        <div class="col-lg-4 col-sm-6 col-md-6 mx-auto mx-lg-0 text-center">
                            <i v-show="changed === false && person.image_path === null"
                               class="fa fa-user-circle fa-4x"></i>
                            <div v-show="changed === false && person.image_path !== '' && person.image_path !== null"
                                 class="mx-auto"
                                 style="width: 50%; height: auto">

                                <img :src='"/storage/" + person.image_path'
                                     class="img-thumbnail preview">
                            </div>
                            <div v-show="changed"
                                 class="text-center">
                                <img ref="img"
                                     class="mw-100 mx-auto"
                                     style="max-height: 30rem" />
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-6 d-flex mt-lg-0 mt-3">
                            <div class="custom-file mb-2 align-self-center">
                                <input type="file"
                                       class="custom-file-input"
                                       name="file"
                                       @change="fileChange">
                                <label class="custom-file-label"
                                       for="customFile">
                                    <i class="fa fa-upload"></i> Bild hochladen..
                                </label>
                            </div>
                            <div class="alert alert-danger mt-2"
                                 role="alert"
                                 v-if="errors.hasError('file')">
                                <ul class="m-0">
                                    <li :key="error.file"
                                        v-for="error in errors.getError('file')">
                                        {{ error }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <label for="email">Email:</label>
                <text-to-image @updated-image="updateEmail"
                               @updating-start="updatingEmail = true"
                               :image-prop="person.email">
                </text-to-image>

                <div class="form-group d-flex">
                    <button type="submit"
                            :disabled="!working && updatingEmail"
                            class="btn btn-info mr-2 ml-auto">
                        <i v-show="!working && !updatingEmail"
                           class="fa fa-edit"></i>
                        <i v-show="working || updatingEmail"
                           class="fa fa-spinner fa-pulse"></i>
                        Bearbeiten
                    </button>

                    <a :href="'/admin/person/' + person.category.name"
                       class="btn btn-light border border-dark">
                        <i class="fa fa-times"></i> Abbrechen
                    </a>
                </div>
            </fieldset>
        </form>
    </div>
</template>

<script>
import Cropper from "Cropperjs";
import Errors from "./Errors.js";
import "cropperjs/dist/cropper.min.css";
import TextArea from "./Textarea.vue";
import TextToImage from "./TextToImage.vue";

export default {
  props: {
    personProp: {
      type: Object,
      required: true
    },
    categories: {
      type: Array,
      required: true
    },
    imagesProp: {
      type: Array,
      required: true
    }
  },
  components: {
    TextArea,
    TextToImage
  },
  data() {
    return {
      person: this.personProp,
      changed: false,
      errors: new Errors(),
      image: "",
      formData: {},
      working: false,
      updatingEmail: false
    };
  },
  methods: {
    sync(data) {
      this.person.markup = data.markup;
      this.person.html = data.html;
    },
    fileChange(e) {
      let temp = this.changed;
      this.image = e.target.files[0];
      let reader = new FileReader();
      reader.onload = e => {
        this.$refs.img.src = reader.result;
        if (!temp) {
          window.cropper = new Cropper(this.$refs.img, {
            aspectRatio: 1,
            viewMode: 1,
            rotatable: true,
            scalable: true,
            checkOrientation: true,
            autoCrop: true,
            autoCropArea: 1
          });
        } else {
          window.cropper.replace(this.$refs.img.src);
        }
      };
      let url = reader.readAsDataURL(this.image);
      this.changed = true;
    },
    update() {
      let vue = this;
      this.working = true;
      this.formData = new FormData();
      this.formData.append("name", this.person.name);
      this.formData.append("markup", this.person.markup);
      this.formData.append("html", this.person.html);
      this.formData.append("email", this.person.email ? this.person.email : "");
      this.formData.append("person_category_id", this.person.category.id);
      this.formData.append("_method", "PUT");
      if (this.changed) {
        window.cropper.getCroppedCanvas().toBlob(
          blob => {
            vue.formData.append("file", blob, "person.jpeg");
            this.post(vue.formData);
          },
          "image/jpeg",
          0.5
        );
      } else {
        this.post(this.formData);
      }
    },
    post(formData) {
      axios
        .post(`/admin/person/${this.person.id}`, formData)
        .then(msg => {
          this.person = msg.data.person;
          this.changed = false;
          this.working = false;
          setTimeout(() => {
            location.href = `/admin/person/${this.person.category.name}`;
          }, 500);
        })
        .catch(errors => {
          this.errors.setErrors(errors.response.data.errors);
          this.working = false;
        });
    },
    updateEmail(data) {
      this.person.email = data.image;
      this.updatingEmail = false;
    }
  },
  filters: {
    ucfirst: function(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  }
};
</script>

<style>
.cropper-view-box,
.cropper-face {
  border-radius: 50%;
}
.preview {
  border-radius: 50%;
}
</style>
