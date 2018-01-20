<template>
    <div class="text-center" v-cloak>
        <img v-if="state" :src="path" :class="[classes,'img-fluid']">
    </div>
</template>
<script>
/* global axios*/
export default {
  props: {
    url: {
      default: "",
      type: String
    },
    id: {
      type: Number,
      default: -1
    },
    classes: {
      type: String,
      default: ""
    }
  },
  data: () => {
    return {
      path: "",
      state: false
    };
  },
  mounted: function() {
    if (this.url !== "") {
      this.path = this.url;
      this.state = true;
    } else {
      let vue = this;
      axios.post(`/bild/${this.id}`).then(data => {
        vue.path = "/storage/" + data.data.path;
        vue.state = true;
      });
    }
  }
};
</script>

<style scoped>
img {
  max-height: 15rem;
  width: auto;
}
</style>
