<template lang="html">
    <div>
        <div class="card">
            <div class="card-header">
                Neue Sektion
            </div>
            <div class="card-body">
                <form @submit.prevent="store">
                    <div class="mb-3">
                        <label for="title" hidden>Titel:</label>
                        <input type="text" v-model="site_title" class="form-control" id="title" placeholder="Titel..">
                    </div>

                    <div class="mb-3 d-flex">
                        <button type="submit" class="btn btn-success ms-auto">
                            <i class="fa fa-plus" /> Hinzufügen
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <div class="form-check form-switch my-3">
            <input class="form-check-input" type="checkbox" id="draggable" v-model="editable">
            <label class="form-check-label" for="draggable">
                Sortiere Sektionen
            </label>
        </div>

        <!-- <div v-for="(key, value) in peopleGroupProp">
            {{value}}
            <div v-for="person in key">
                {{person}}
            </div>
        </div> -->

        <draggable
            v-model="sites"
            item-key="id"
            @start="isDragging=true"
            @end="update(true)"
            v-bind="dragOptions"
            tag="transition-group"
            :component-data="{ name: 'flip-list' }">

            <template #item="{ element }">
                <div class="card mb-4" :style="[ editable ? 'cursor:move' : '' ]">
                    <site-edit :site-prop="element" :images-prop="imagesProp" :people-group-prop="peopleGroupProp" @siteDestroy="postSiteDestroy"></site-edit>
                </div>
            </template>
        </draggable>
        <msg />
    </div>
</template>

<script>
/* global axios */
import Message from "./Message.vue";
import Draggable from "vuedraggable";
import SiteEdit from "./SiteEdit.vue"

export default {
  components: {
    draggable: Draggable,
    msg: Message,
    SiteEdit,
  },
  props: {
    sitesProp: {
      type: Array,
      required: true,
    },
    siteCategoryProp: {
      type: Object,
      required: true,
    },
    imagesProp: {
      type: Array,
      required: true,
    },
    peopleGroupProp: {
      required: true,
    }
  },
  data: () => {
    return {
      site_title: "",
      sites: [],
      isDragging: false,
      editable: false,
    };
  },
  computed: {
    dragOptions() {
      return {
        animation: 0,
        disabled: !this.editable,
        ghostClass: "ghost",
        dragClass: "drag",
      };
    }
  },
  created: function() {
    this.sites = this.sitesProp
    this.sortSites()
  },
  methods: {
    sortSites() {
      return this.sites.sort((a, b) => {
        return a.order > b.order
      })
    },
    store() {
      axios
        .post(route('site_store'), {
          title: this.site_title,
          site_category_id: this.siteCategoryProp.id,
          order: this.sites.length + 1
        })
        .then(msg => {
          this.site_title = ""
          this.sites.push(msg.data.site)
          this.emitter.emit("msg-event", [msg.data.status])
          this.update(false)
        })
        .catch(errors => {
          this.emitter.emit("msg-event", [errors.response.data.errors, "danger"])
        });
    },
    update(show_msg) {
      this.isDragging = false
      this.sites = this.sites.map((element, index) => {
        element.order = index
        return element
      })
      axios
        .post(route('site_order_update'), {
          sites: this.sites.map(element => {
            return { id: element.id, order: element.order + 1 };
          })
        })
        .then(msg => {
          if (show_msg) {
            this.emitter.emit("msg-event", [msg.data.status])
          }
        })
        .catch(() => {
          this.emitter.emit("msg-event", [ "Es ist ein Fehler aufgetreten.", "danger" ])
        })
    },
    postSiteDestroy(site) {
      this.sites.splice(this.sites.indexOf(site), 1)
      this.update(false)
    }
  }
}
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
