<template>
    <transition name="fade">
        <div class="alert info" :class="messageClass" role="alert" v-show="show">
            <i class="fa fa-info-circle" /> {{ message }}
        </div>
    </transition>
</template>

<script>
import { EventBus } from "./EventBus.js";

export default {
  data: () => {
    return {
      show: false,
      message: "",
      type: "success"
    };
  },
  computed: {
    messageClass: function() {
      return "alert-" + this.type;
    }
  },
  mounted() {
    let vue = this;
    EventBus.$on("msg-event", (message, type = "success") => {
      vue.message = message;
      vue.type = type;
      vue.show = true;
      setTimeout(() => {
        vue.show = false;
      }, 2000);
    });
  }
};
</script>

<style scoped>
.info {
  position: absolute;
  top: 5px;
  right: 0;
  z-index: 20;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease-out;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>