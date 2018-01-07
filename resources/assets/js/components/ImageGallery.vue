<template>
    <div class="row">
        <div class="col-lg-3" v-for="image in images" v-bind:key="image.id">
            <div class="card m-1 h-100">
                <div class="card-body row">
                    <div class="col-lg-3">
                        <img :src="`/storage/${image.path}`" class="img-fluid">
                    </div>
                    <div class="col-lg-9 d-flex">
                        <div>
                            <h4 v-if="image.name">{{image.name}}</h4>
                            <p>Bild ID: {{image.id}}</p>
                        </div>
                        <form @submit.prevent="destroy(image)" class="ml-auto">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
import { EventBus } from "./EventBus.js";
export default {
  props: ["images-prop"],
  data: () => {
    return {
      images: []
    };
  },
  methods: {
    destroy(image) {
      let vue = this;
      axios
        .delete(`/admin/bilder/${image.id}`)
        .then(msg => {
          vue.images.splice(vue.images.indexOf(image), 1);
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(errors => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    }
  },
  created: function() {
    this.images = this.imagesProp;

    let vue = this;
    EventBus.$on("image-added", function(image) {
      vue.images.push(image);
    });
  }
};
</script>
