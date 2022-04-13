<template>
    <div class="row mx-0">
        <div class="col-lg-2 col-md-3 mb-2 px-0" v-for="image in images" :key="image.id">
            <div class="card h-100 mx-1">
                <div class="card-body d-flex flex-column">
                    <div>
                        <h6 v-if="image.name">{{ image.name }}</h6>
                    </div>
                    <div>
                        <img :src="`/storage/${image.path}`" class="img-fluid">
                    </div>
                    <div class="mt-auto">
                        <form @submit.prevent="destroy(image)" class="mt-2">
                            <button type="submit" class="btn btn-danger form-control">
                                <i class="fa fa-trash-alt" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/* global axios*/
export default {
  props: {
    imagesProp: {
      type: Array,
      required: true
    }
  },
  data: function() {
    return {
      images: this.imagesProp
    };
  },
  created: function() {
    this.emitter.on("image-added", ([image]) => {
      this.images.push(image);
    });
  },
  methods: {
    destroy(image) {
      let vue = this;
      axios
        .delete(`/admin/bild/${image.id}`)
        .then(msg => {
          vue.images.splice(vue.images.indexOf(image), 1);
          this.emitter.emit("msg-event", [ msg.data.status ]);
        })
        .catch(() => {
          this.emitter.emit(
            "msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ]
          );
        });
    }
  }
};
</script>
