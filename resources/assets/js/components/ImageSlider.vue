<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
import Owl from "owl.carousel";

import "owl.carousel/dist/assets/owl.carousel.min.css";
import "owl.carousel/dist/assets/owl.theme.default.min.css";

export default {
  mounted() {
    $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
        loop: true,
        items: 3,
        autoplay: true,
        autoplayTimeout: 2000,
        margin: 10,
        nav: true,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 3,
            nav: true
          }
        }
      });
    });
  }
};
</script>


<style>
.owl-carousel .owl-stage {
  display: flex;
}

.owl-item img {
  width: auto;
  height: 100%;
}
.owl-prev > span,
.owl-next > span {
  padding: 15px;
  font-size: 2em;
}
</style>

