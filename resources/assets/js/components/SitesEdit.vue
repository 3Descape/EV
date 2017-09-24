<template lang="html">
    <div>
        <markdown v-for="site in sites" :key="site.id" :site-prop="site"></markdown>
    </div>
</template>

<script>
import Markdown from './Markdown.vue';
export default {
    props: ['sitesProp'],
    components:{
        "markdown": Markdown
    },
    data (){
        return{
            sites: this.sitesProp
        }
    },
    methods: {
    },
    mounted (){
        console.log(this.sites)
    }
}
</script>

<style lang="css">
</style>
