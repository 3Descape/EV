<script>
import marked from "Marked";
let renderer = new marked.Renderer();

export default {
  props: {
    imagesProp: {
      type: Array,
      required: false
    },
    markupProp: ""
  },
  data() {
    return {
      markup: this.markupProp
    };
  },
  render() {
    return this.$scopedSlots.default({
      compiledMarkdown: this.compiledMarkdown,
      inputEvents: {
        input: e => {
          this.markup = e.target.value;
        }
      },
      inputAttrs: {
        value: this.markup
      }
    });
  },
  computed: {
    compiledMarkdown() {
      if (this.markup) {
        let temp = marked(this.markup, { renderer: renderer });
        let vue = this;
        let compiled = temp.replace(/@(\d+)/g, function(x) {
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
        this.$emit("sync", { markup: this.markup, html: compiled });
        return compiled;
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
  }
};
</script>
