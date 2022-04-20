<template>
    <node-view-wrapper draggable="true" data-drag-handle class="d-inline" as="span">
        <span class="image d-inline">
            <span class="control d-flex my-4">
                <input type="range" min="0" max="100" class="form-range" v-model.number="node.attrs.size">
            </span>
            <span v-html="html" class="content" :class="{'selected' : selected}"></span>
        </span>
    </node-view-wrapper>
</template>

<script>
import { NodeViewWrapper, nodeViewProps } from "@tiptap/vue-3";
import { generateHTML } from '@tiptap/html'
import { nextTick } from '@vue/runtime-core';

export default {
    components: {
        NodeViewWrapper,
    },
    props: nodeViewProps,
    data() {
        return {
            html: ""
        }
    },
    computed: {
        size() {
            return this.node.attrs.size
        },
        src() {
            return this.node.attrs.src
        }
    },
    watch: {
        size(value) {
            this.updateSize(value)
        },
        src(value) {
            this.updateHTML()
        }
    },
    methods: {
        generateHTML(node) {
            return generateHTML(node)
        },
        updateSize(number) {
            this.updateAttributes({
                size: number,
            })

            nextTick(this.updateHTML)
        },
        updateHTML() {
            let content = {
                "type":"doc",
                "content":
                [
                    {
                        "type": this.node.type.name,
                        "attrs": this.node.attrs
                    }
                ]
            }

            this.html = generateHTML(content, this.editor.options.extensions)
        }
    },
    created() {
        this.updateHTML()
    }
};
</script>

<style lang="scss">
.image {
    position: relative;
    .control {
        position: absolute;
        top: 0rem;
        left: 0;
        right: 0;

        input {
            width: 20rem;
        }
    }

    .selected {
        img {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
    }
}
</style>>