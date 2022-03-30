<template>
    <div class="image-slider d-flex algin-items-center">
        <slot></slot>
    </div>
</template>

<script>
import Slick from "slick-carousel";

import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

export default {
  mounted() {
    $(document).ready(function() {
      $(".image-slider").slick({
        dots: true,
        slidesToShow: 2,
        variableWidth: true,
        lazyLoad: "ondemand",
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnFocus: true
      });
    });
  }
};
</script>


<style>
@font-face {
  font-family: Slick;
  src: url("/public/fonts/vendor/slick-carousel/slick.ttf");
}

.slick-slide div img {
  height: 35rem;
}
.slick-dots li button::before {
  opacity: 0.3;
}

.slick-arrow::before {
  color: black;
}
</style>

