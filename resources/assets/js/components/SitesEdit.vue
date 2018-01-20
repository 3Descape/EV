<template lang="html">
    <div>
        <markdown v-for="site in sitesProp" :key="site.id" :site-prop="site" />
    </div>
</template>

<script>
import Markdown from "./Markdown.vue";
export default {
  components: {
    markdown: Markdown
  },
  props: {
    sitesProp: {
      type: Array,
      required: true
    }
  }
};
</script>
