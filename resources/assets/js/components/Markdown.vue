<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex mb-1">
                <button class="btn btn-danger ml-auto"
                        @click="destroy">
                    <i class="fa fa-trash-alt" />
                </button>
            </div>
            <fieldset class="mb-2"
                      :disabled="updatingBody || updatingTitle">
                <form class="input-group mb-2"
                      @submit.prevent="updateTitle">
                    <input type="text"
                           class="form-control"
                           placeholder="Titel"
                           v-model="site.title">
                    <div class="input-group-prepend">
                        <button type="submit"
                                class="input-group-text bg-light">
                            <div v-show="!updatingTitle"
                                 class="fa fa-sync-alt" />
                            <div v-show="updatingTitle"
                                 class="fa fa-spinner fa-pulse" />
                        </button>
                    </div>
                </form>

                <form @submit.prevent="updateBody">
                    <textarea name="name"
                              class="form-control"
                              v-model="site.markup"
                              rows="5" />
                    <button class="btn btn-info form-control mt-2"
                            type="submit">
                        <i v-show="!updatingBody"
                           class="fa fa-pencil-alt" /> Text aktualisieren..
                        <i v-show="updatingBody"
                           class="fa fa-spinner fa-pulse"
                           disabled />
                    </button>
                </form>
            </fieldset>

            <div class="card">
                <div class="card-header"
                     role="tab"
                     id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse"
                           :href="'#collapse' + site.id"
                           aria-expanded="false"
                           aria-controls="'collapse' + site.id"
                           class="text-dark">
                            Vorschau
                            <i class="fa fa-caret-down" />
                        </a>
                    </h5>
                </div>

                <div :id="'collapse' + site.id"
                     class="collapse"
                     role="tabpanel">
                    <div class="card-body"
                         v-html="compiledMarkdown" />

                </div>
                <div tesss
                     v-html="test"></div>
            </div>
        </div>
    </div>
</template>

<script>
/* global axios */
const marked = require("marked");
let renderer = new marked.Renderer();
import PeopleList from "./PeopleList.vue";

renderer.image = function(href, title, text) {
  var out =
    '<img class="img-fluid d-block mx-auto" style="max-height: 400px;" src="' +
    href +
    '" alt="' +
    text +
    '"';
  if (title) {
    out += ' title="' + title + '"';
  }
  out += this.options.xhtml ? "/>" : ">";
  return out;
};

export default {
  props: {
    siteProp: {
      type: Object,
      required: true
    },
    imagesProp: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      site: this.siteProp,
      updatingBody: false,
      updatingTitle: false,
      test: "<people-list category='sga'></people-list>"
    };
  },
  components: {
    PeopleList: PeopleList
  },
  computed: {
    compiledMarkdown: function() {
      if (this.site.markup) {
        let temp = marked(this.site.markup, { renderer: renderer });

        let vue = this;

        return temp.replace(/@(\d+)/g, function(x) {
          let ids = vue.imagesProp.map(function(element) {
            return element.id;
          });
          let id = ids.indexOf(Number(x.substring(1)));
          return id !== -1
            ? '<img src="/storage/' +
                vue.imagesProp[id].path +
                '"/ class="img-fluid d-block mx-auto" style="max-height: 400px;">'
            : x;
        });
      } else {
        return "";
      }
    }
  },
  created: function() {
    marked.setOptions({
      gfm: true,
      breaks: true,
      tables: true
    });

    this.$forceUpdate();
  },
  methods: {
    updateBody() {
      this.updatingBody = true;
      let vue = this;
      axios
        .post(`/admin/seite/update/${vue.site.id}/text`, {
          rawData: vue.site.markup,
          compiledData: vue.compiledMarkdown
        })
        .then(() => {
          this.updatingBody = false;
        })
        .catch(() => {});
    },
    updateTitle() {
      this.updatingTitle = true;
      let vue = this;
      axios
        .post(`/admin/seite/update/${vue.site.id}/titel`, {
          title: vue.site.title
        })
        .then(() => {
          this.updatingTitle = false;
        })
        .catch(() => {});
    },
    destroy() {
      this.$emit("delete", this.site);
    }
  }
};
</script>
<style>

</style>
