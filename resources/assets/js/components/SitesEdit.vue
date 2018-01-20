<template lang="html">
    <div>
        <draggable element="div" v-model="sites" @start="isDragging=true" @end="update"
                   :options="dragOptions">

            <transition-group type="transition" :name="'flip-list'">
                <markdown v-for="site in sites" :key="site.id" :site-prop="site" />
            </transition-group>
        </draggable>
        <msg />
    </div>
</template>

<script>
/* global axios */
import Message from './Message.vue';
import { EventBus } from "./EventBus.js";
import Draggable from "vuedraggable";
import Markdown from "./Markdown.vue";
export default {
  components: {
    markdown: Markdown,
    draggable: Draggable,
    msg: Message
  },
  props: {
    sitesProp: {
      type: Array,
      required: true
    }
  },
  data: () => {
    return {
      sites: [],
      isDragging: false
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 0,
        ghostClass: "ghost",
        dragClass: "drag"
      };
    }
  },
  created: function() {
    this.sites = this.sitesProp;
    this.sortSites();
  },
  methods: {
    sortSites() {
      return this.sites.sort((a, b) => {
        return a.order > b.order;
      });
    },
    update() {
      this.isDragging = false;
      this.sites = this.sites.map((element, index) => {
        element.order = index;
        return element;
      });
      let vue = this;
      axios
        .post("/admin/seite/update/reihenfolge", {
          sites: this.sites.map(element => {
            return { id: element.id, order: element.order + 1 };
          })
        })
        .then(msg => {
          EventBus.$emit("msg-event", msg.data.status);
        })
        .catch(() => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    }
  }
};
</script>
<style scoped>
.flip-list-move {
  transition: transform 0.2s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: hsl(0, 0%, 90%);
}
.card {
  cursor: move;
}
.sortable-chosen {
  background-color: hsv(0, 0, 80%);
}
.drag {
  background-color: white;
  opacity: 1;
}
</style>
