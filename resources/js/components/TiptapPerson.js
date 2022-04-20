import {
    Node,
    mergeAttributes,
} from '@tiptap/core'

import { VueNodeViewRenderer } from '@tiptap/vue-3'
import TiptapPersonView from './TiptapPersonView.vue'

export default Node.create({
    name: 'personnode',

    priority: 100,

    group: 'block',

    draggable: true,

    atom: true,

    addOptions() {
      return {
        HTMLAttributes: {},
        people: null,
      }
    },
    addAttributes() {
        return {
            personId: {
                parseHTML: element => element.getAttribute('person-id') || null,
            },
        }
    },
    renderHTML({ HTMLAttributes }) {
      return ['person', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes)]
    },
    parseHTML() {
        return [
            { tag: 'person' },
        ]
    },
    addNodeView() {
        return VueNodeViewRenderer(TiptapPersonView)
    },
    addCommands() {
        return {
            setPerson: (people, replace = false, parseOptions = {}) => ({ chain, tr }) => {
                if(!Array.isArray(people))
                {
                    people = [people]
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
})