<template>
    <div class="container-fluid">
        <textarea name="name" class="form-control" v-model="input" row="10"></textarea>
        <div v-html="compiledMarkdown"></div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                input: "",
            }
        },
        computed: {
            compiledMarkdown: function(){
                var test = marked(this.input);
                console.log(test);
                return test;
            }
        },
        created: function(){
            marked.setOptions({
                gfm: true,
                breaks: true,
                tables: true,
            });
        }
    }
</script>
