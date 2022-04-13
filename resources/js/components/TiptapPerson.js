import {
    Node,
    nodeInputRule,
    mergeAttributes,
} from '@tiptap/core'

import { VueNodeViewRenderer } from '@tiptap/vue-3'
import TiptapPerson from "./TiptapPerson.vue"

export const PersonNode = Node.create({
    name: 'personnode',

    priority: 100,

    addAttributes() {
        return {
            personId: {
                default: null,
            },
        }
    },

    addOptions() {
        return {
            people: null
        }
    },

    group: 'block',

    content: '',

    parseHTML() {
        return [
            { tag: 'person' },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['person', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes)]
    },
    addCommands() {
        return {
            setPerson: (people, replace = false, parseOptions = {}) => ({ chain, editor, tr, dispatch }) => {
                if(!Array.isArray(people))
                {
                    console.warn("TipTapPerson.js People must be of type array!")
                    return;
                }

                const raw_content = people.map(person => {
                    return {
                        type: this.name,
                        attrs: { personId: person.id }
                    }
                })

                if(replace)
                {
                    return chain().insertContentAt(tr.selection.from, raw_content).run()
                }

                return chain().insertContentAt(tr.selection.to, raw_content).run()
            },
        }
    },
    addNodeView() {
        return VueNodeViewRenderer(TiptapPerson)
    },
})