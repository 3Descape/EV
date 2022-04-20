<template>
    <node-view-wrapper draggable="true" data-drag-handle>
        <person :person="person" :class="{ 'selected' : this.selected }"></person>
    </node-view-wrapper>
</template>

<script>
import Person from "./Person.vue"
import { NodeViewWrapper, nodeViewProps } from "@tiptap/vue-3";
export default {
    components: {
        NodeViewWrapper,
        Person,
    },
    props: nodeViewProps,
    data() {
        return {
            person: null
        }
    },
    mounted()
    {
        this.person = this.extension.options.people.find(person => person.id == this.node.attrs.personId)
    }
};
</script>

<style scoped>
    .selected {
        border: 1px solid black;
    }
</style>>