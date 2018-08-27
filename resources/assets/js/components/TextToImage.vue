<template>
    <div>
        <div class="d-flex">
            <input type="text"
                   class="form-control mb-3"
                   v-model="text"
                   id="email"
                   @keyup="updateImage"
                   placeholder="Email...">

            <button class="btn-danger btn ml-2 align-self-start"
                    @click="deleteEmail"
                    type="button">
                <i class="fa fa-trash"></i>
            </button>
        </div>
        <label v-if="text && updating"
               for="">
            <i class="fa fa-sync-alt fa-spin"></i>
            Generiere Bild
        </label>
        <div v-if="text || image">
            <p class="mb-1">Vorschau:</p>
            <div v-if="text"
                 ref="html"
                 v-html="text"
                 class="d-inline-block">
            </div>
            <img v-else
                 :src="image"
                 alt="">
        </div>
    </div>
</template>

<script>
import Html2Canvas from "html2canvas";
import debounce from "lodash/debounce";

export default {
  data() {
    return {
      text: "",
      image: this.imageProp,
      updating: false
    };
  },
  props: ["imageProp"],
  methods: {
    updateImage() {
      this.updating = true;
      this.$emit("updating-start");
      this.generateImage();
    },
    generateImage: debounce(
      function() {
        let html = this.$refs.html;
        Html2Canvas(html).then(
          canvas => {
            let image = canvas.toDataURL("image/png");
            this.image = image;
            this.$emit("updated-image", { image: image });
            this.updating = false;
          },
          {
            backgroundColor: null
          }
        );
      },
      1500,
      {}
    ),
    deleteEmail() {
      this.text = "";
      this.image = "";
      this.$emit("updated-image", { image: "" });
    }
  },
  mounted() {
    console.log("created");
  }
};
</script>
