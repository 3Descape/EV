<template lang="html">
    <div>
        <markdown v-for="site in sitesProp" :key="site.id" :site-prop="site"></markdown>
    </div>
</template>

<script>
import Markdown from './Markdown.vue';
export default {
    props: ['sitesProp'],
    components:{
        "markdown": Markdown
    }
}
</script>
