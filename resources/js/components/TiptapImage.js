import Image from '@tiptap/extension-image'

import { VueNodeViewRenderer } from '@tiptap/vue-3'
import TiptapImageView from './TiptapImageView.vue'

export default Image.extend({
    addAttributes() {
        return {
            ...this.parent?.(),
            size: {
                default: this.options.defaultSize,
                // renderHTML: attributes => {
                //     if(!attributes.size || attributes.size == 100) return {}
                //     return {
                //         style: `width: ${attributes.size}${this.options.sizeUnit}`,
                //     }
                // },
                parseHTML: element => element.stile.width || this.options.defaultSize,
            },
        };
    },
    addOptions() {
        return {
            ...this.parent?.(),
            HTMLAttributes: {
                // class: 'img-fluid'
            },
            defaultSize: 100,
            sizeUnit: "%",
            inline: true,
        }
    },
    addNodeView() {
        return VueNodeViewRenderer(TiptapImageView)
    }
})