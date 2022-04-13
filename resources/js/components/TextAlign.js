import { end } from '@popperjs/core'
import { Extension } from '@tiptap/core'
import { TextAlign as TipTapTextAlign } from '@tiptap/extension-text-align'

export const TextAlign = TipTapTextAlign.extend({
  addGlobalAttributes() {
    return [
      {
        types: this.options.types,
        attributes: {
          textAlign: {
            default: this.options.defaultAlignment,
            renderHTML: attributes => {
              if (attributes.textAlign === this.options.defaultAlignment) {
                return null
              }

              return {
                class: `${attributes.textAlign}`
              }
            },
            parseHTML: element => {
              return [...element.classList].find(e => attributes.alignments.includes(e)) || this.options.defaultAlignment;
            }
          }
        }
      }
    ]
  }
})