<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
import Flickity from "flickity";
import FlickityFullScreen from "flickity-fullscreen";

import "flickity/dist/flickity.min.css";
import "flickity-fullscreen/fullscreen.css";
export default {
  mounted() {
    var flkty = new Flickity(this.$el, {
      // options
      cellAlign: "left",
      contain: false,
      autoPlay: 2000,
      pauseAutoPlayOnHover: true,
      wrapAround: true,
      fullscreen: true
    });
  }
};
</script>

