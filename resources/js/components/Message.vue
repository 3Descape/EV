<template>
    <transition name="fade">
        <div class="alert info"
             :class="messageClass"
             role="alert"
             v-show="show">
            <div class="d-flex">
                <i class="fa fa-info-circle align-self-start me-1 mt-1" />
                <div v-html="message"></div>
            </div>
        </div>
    </transition>
</template>

<script>
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
    this.emitter.on("msg-event", ([message, type = "success"]) => {
      if (message instanceof Object) {
        let html = "";
        for (const key of Object.keys(message)) {
          html += '<ul class="pl-2 mb-0 list-unstyled">';
          message[key].forEach(elem => {
            html += `<li>&#x25cf; ${elem}</li>`;
          });
          html += "</ul>";
        }

        this.message = html;
      } else
      {
        this.message = message;
      }
      this.type = type;
      this.show = true;
      setTimeout(() => {
        this.show = false;
      }, 10000);
    });
  }
};
</script>

<style scoped>
.info {
  position: fixed;
  top: 10px;
  right: 10px;
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