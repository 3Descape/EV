<template lang="html">
    <div>
        <div>
            <form @submit.prevent="store">
                <div class="form-group">
                    <label for="title">Überschrift:</label>
                    <input type="text" v-model="site_title" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus" /> Hinzufügen
                    </button>
                </div>
            </form>
        </div>

        <div class="custom-control custom-checkbox my-3">
            <input class="custom-control-input" type="checkbox" id="draggable" v-model="editable">
            <label class="custom-control-label" for="draggable">
                Sortierbar
            </label>
        </div>

        <draggable element="div" :style="editable? 'cursor:move' : ''" v-model="sites" @start="isDragging=true" @end="update(true)"
                   :options="dragOptions">
            <transition-group type="transition" :name="'flip-list'">
                <div v-for="site in sites" :key="site.id" class="card mb-4">
                    <site-edit :site-prop="site" :images-prop="imagesProp" @destroy="destroy"></site-edit>
                </div>
            </transition-group>
        </draggable>
        <msg />
    </div>
</template>

<script>
/* global axios */
import Message from "./Message.vue";
import { EventBus } from "./EventBus.js";
import Draggable from "vuedraggable";

export default {
  components: {
    draggable: Draggable,
    msg: Message
  },
  props: {
    sitesProp: {
      type: Array,
      required: true
    },
    siteCategoryProp: {
      type: Object,
      required: true
    },
    imagesProp: {
      type: Array,
      required: true
    }
  },
  data: () => {
    return {
      site_title: "",
      sites: [],
      isDragging: false,
      editable: false
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 0,
        disabled: !this.editable,
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
    store() {
      let vue = this;
      axios
        .post("/admin/seite", {
          title: vue.site_title,
          site_category_id: vue.siteCategoryProp.id,
          order: vue.sites.length + 1
        })
        .then(msg => {
          vue.site_title = "";
          vue.sites.push(msg.data.site);
          EventBus.$emit("msg-event", msg.data.status);
          this.update(false);
        })
        .catch(() => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    update(show_msg) {
      this.isDragging = false;
      this.sites = this.sites.map((element, index) => {
        element.order = index;
        return element;
      });
      axios
        .post("/admin/seite/update/reihenfolge", {
          sites: this.sites.map(element => {
            return { id: element.id, order: element.order + 1 };
          })
        })
        .then(msg => {
          if (show_msg) {
            EventBus.$emit("msg-event", msg.data.status);
          }
        })
        .catch(() => {
          EventBus.$emit(
            "msg-event",
            "Es ist ein Fehler aufgetreten.",
            "danger"
          );
        });
    },
    destroy(site) {
      this.sites.splice(this.sites.indexOf(site), 1);
      this.update(false);
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
.sortable-chosen {
  background-color: hsv(0, 0, 80%);
}
.drag {
  background-color: white;
  opacity: 1;
}
</style>
