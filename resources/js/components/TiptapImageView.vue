<template>
    <node-view-wrapper draggable="true" data-drag-handle class="tiptap-image-view" as="div" :style="{width: `${size}%`}" :class="{'tiptap-image-view-selected' : selected}">
        <div class="tiptap-image-view-control">
            <button class="btn btn-warning mt-2" type="button" @click="openImageSettings">
                Menü
            </button>

            <div class="tiptap-image-view-menu" :style="menuStyle" v-show="menuIsVisible" @mouseleave="menuIsVisible = false">
                <label :for="`tiptap-image-view-menu-size-${componentId}`" class="form-label mb-0">Größe:</label>
                <input type="range" min="0" max="100" class="tiptap-image-view-input form-range" v-model.number="node.attrs.size" :id="`tiptap-image-view-menu-size-${componentId}`">
            </div>
        </div>
        <div v-html="html" :ref="(el) => this.imageRef = el.querySelector('img')" class="tiptap-image-view-content"></div>
    </node-view-wrapper>
</template>

<script>
import { NodeViewWrapper, nodeViewProps } from "@tiptap/vue-3"
import { generateHTML } from '@tiptap/html'
import { nextTick } from '@vue/runtime-core'
import uniqueId from 'lodash/uniqueId'

export default {
    components: {
        NodeViewWrapper,
    },
    props: nodeViewProps,
    data() {
        return {
            html: "",
            imageRef: null,
            menuIsVisible: false,
            menuStyle: {
                top: "0px",
                left: "0px",
            },
            componentId: 0,
        }
    },
    methods: {
        openImageSettings(event)
        {
            this.menuStyle.top = `${event.clientY}px`
            this.menuStyle.left = `${event.clientX}px`
            this.menuIsVisible = true
        },
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
        },
        imageRef(image) {
            image.classList.add("tiptap-image-view-image")
        }
    },
    created() {
        this.updateHTML()
        this.componentId = uniqueId()
    },
};
</script>

<style lang="scss">
.tiptap-image-view {
    position: relative;
    display: inline-block;

    &.tiptap-image-view-selected {
        box-shadow: rgba(104, 225, 255, 0.24) 0px 5px 15px;
    }

    .tiptap-image-view-control {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        text-align: center;

        &:hover {
            background-color: rgba(0, 255, 76, 0.2);
        }

        .tiptap-image-view-menu {
            position: fixed;
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: white;
            display: flex;
            align-content: center;

            .tiptap-image-view-input {
                margin-left: 1rem;
            }
        }
    }

    .tiptap-image-view-content {

        display: inline-block;
        width: 100%;

        .tiptap-image-view-image {
            width: 100%;
        }
    }
}
</style>>