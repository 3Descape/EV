<template>
    <div class="card mb-4">
        <div class="card-body">
            <fieldset class="mb-2" :disabled="updatingBody || updatingTitle">
                <form class="input-group mb-2" @submit.prevent="updateTitle">
                    <input type="text" class="form-control" placeholder="Titel" v-model="site.title">
                    <div class="input-group-prepend">
                        <button type="submit" class="input-group-text bg-light">
                            <div v-if="!updatingTitle" class="fa fa-refresh"></div>
                            <div v-if="updatingTitle" class="fa fa-spinner fa-pulse"></div>
                        </button>
                    </div>

                </form>

                <form @submit.prevent="updateBody">
                    <textarea name="name" class="form-control" v-model="site.markup" rows="5"></textarea>
                    <button class="btn btn-info form-control mt-2" type="submit">
                        <i v-if="!updatingBody" class="fa fa-edit"></i> Text aktualisieren..
                        <i v-if="updatingBody" class="fa fa-spinner fa-pulse" disabled></i>
                    </button>
                </form>
            </fieldset>

            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" :href="'#collapse' + site.id" aria-expanded="false" aria-controls="'collapse' + site.id" class="text-dark">
                            Vorschau
                            <i class="fa fa-caret-down"></i>
                        </a>
                    </h5>
                </div>

                <div :id="'collapse' + site.id" class="collapse" role="tabpanel">
                    <div class="card-body" v-html="compiledMarkdown">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let marked = require("marked");
let renderer = new marked.Renderer();

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
  props: ["siteProp"],
  data() {
    return {
      site: this.siteProp,
      updatingBody: false,
      updatingTitle: false
    };
  },
  computed: {
    compiledMarkdown: function() {
      if (this.site.markup) {
        return marked(this.site.markup, { renderer: renderer });
      } else {
        return "";
      }
    }
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
        .then(response => {
          this.updatingBody = false;
        })
        .catch(errors => {});
    },
    updateTitle() {
      this.updatingTitle = true;
      let vue = this;
      axios
        .post(`/admin/seite/update/${vue.site.id}/titel`, {
          title: vue.site.title
        })
        .then(response => {
          this.updatingTitle = false;
        })
        .catch(errors => {});
    }
  },
  created: function() {
    marked.setOptions({
      gfm: true,
      breaks: true,
      tables: true
    });
  }
};
</script>
