<template>
    <div class="col-lg-10 col-md-12 mx-auto">
        <form @submit.prevent="update">
            <fieldset :disabled="working">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" v-model="person.name">

                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                        <ul class="m-0">
                            <li :key="error.name" v-for="error in errors.getError('name')">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>

                <label for="body">Beschreibung:</label>
                <text-area  :images-prop="imagesProp"
                            :people-group-prop="peopleGroupProp"
                            v-model="person.markup">
                </text-area>

                <div class="mb-3">
                    <label for="category">Kategorie</label>
                    <select name="people_category_id" v-model="person.category" class="form-select" id="category">
                        <option v-for="category in categories" :key="category.id" :value="category"> {{ucfirst(category.name)}}</option>
                    </select>
                    <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('people_category_id')">
                        <ul class="m-0">
                            <li :key="error.people_category_id" v-for="error in errors.getError('people_category_id')">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>

                <label for="email">Email:</label>
                <input type="text" class="form-control mb-3" v-model="person.email" id="email" placeholder="Email...">

                <div class="mb-3" v-if="person.category.has_image">
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
                            <div class="mb-2 align-self-center">
                                <input type="file"
                                       class="form-control"
                                       name="file"
                                       @change="fileChange">
                                <label class="form-label"
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

                <div class="mb-3 d-flex">
                    <button type="submit" :disabled="working || updatingEmail" class="btn btn-success me-2 ms-auto">
                        <i v-show="!working" class="fa fa-edit"></i>
                        <i v-show="working" class="fa fa-spinner fa-pulse"></i>
                        Hinzufügen
                    </button>

                    <a :href="'/admin/person/' + person.category.name" class="btn btn-light border border-dark">
                        <i class="fa fa-times"></i> Abbrechen
                    </a>
                </div>
            </fieldset>
        </form>
        <msg/>
    </div>
</template>

<script>
import Cropper from "Cropperjs";
import Errors from "./Errors.js";
import Message from "./Message.vue";
import TextArea from "./Textarea.vue";

import "cropperjs/dist/cropper.min.css";
export default {
  props: {
    category: {
      type: Object,
      required: true,
    },
    categories: {
      type: Array,
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
      person: {
        name: "",
        markup: "",
        category: this.category,
        image_path: null,
        email: ""
      },
      updatingEmail: false,
      changed: false,
      errors: new Errors(),
      image: "",
      working: false
    };
  },
  components: {
    msg: Message,
    TextArea,
  },
  methods: {
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
      reader.readAsDataURL(this.image);
      this.changed = true;
    },
    async update() {
      this.working = true;
      let formData = new FormData();
      formData.append("name", this.person.name);
      formData.append("markup", JSON.stringify(this.person.markup));
      formData.append("email", this.person.email);
      formData.append("person_category_id", this.person.category.id);
      if (this.changed) {
        const blob = await new Promise(resolve => window.cropper.getCroppedCanvas().toBlob(resolve, "image/jpeg", 0.5))
        formData.append("file", blob, "person.jpeg");
      }
      this.post(formData);
    },
    post(formData) {
      axios
        .post(route('person_store'), formData)
        .then(msg => {
          this.changed = false;
          this.working = false;
          this.person = msg.data.person;
          this.emitter.emit("msg-event", [msg.data.msg]);
          location.href = route('person_index', this.person.category.name);
        })
        .catch(errors => {
          console.log(errors.response.data);
          this.errors.setErrors(errors.response.data.errors);
          this.working = false;
        });
    },
    updateEmail(data) {
      this.person.email = data.image;
      this.updatingEmail = false;
    },
    ucfirst: function(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  },
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
