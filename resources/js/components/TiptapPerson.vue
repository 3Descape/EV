<template>
    <node-view-wrapper>
        <person :person="person" class="person"></person>
    </node-view-wrapper>
</template>

<script>
import Person from "./Person.vue"
import { NodeViewWrapper, nodeViewProps } from '@tiptap/vue-3'
export default {
    components: {
        NodeViewWrapper,
        Person
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
}
</script>