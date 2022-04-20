<template>
    <div>
        <div v-if="editor">
            <button type="button" @click="editor.chain().focus().setParagraph().run()" :class="[ baseClass, editor.isActive('paragraph') ? activeClass : inactiveClass ]">
                <i class="fa fa-t"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 1 }) ? activeClass : inactiveClass ]">
                H1
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 2 }) ? activeClass : inactiveClass ]">
                H2
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 3 }) ? activeClass : inactiveClass ]">
                H3
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 4 }) ? activeClass : inactiveClass ]">
                H4
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 5 }) ? activeClass : inactiveClass ]">
                H5
            </button>
            <button type="button" @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="[ baseClass, editor.isActive('heading', { level: 6 }) ? activeClass : inactiveClass ]">
                H6
            </button>
            <button type="button" @click="editor.chain().focus().toggleBold().run()" :class="[ baseClass, editor.isActive('bold') ? activeClass : inactiveClass ]">
                <i class="fa fa-bold"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleItalic().run()" :class="[ baseClass, editor.isActive('italic') ? activeClass : inactiveClass ]">
                <i class="fa fa-italic"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleUnderline().run()" :class="[ baseClass, editor.isActive('underline') ? activeClass : inactiveClass ]">
                <i class="fa fa-underline"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleStrike().run()" :class="[ baseClass, editor.isActive('strike') ? activeClass : inactiveClass ]">
                <i class="fa fa-strikethrough"></i>
            </button>
            <button type="button" @click="editor.chain().focus().setTextAlign('text-start').run()" :class="[ baseClass, editor.isActive({textAlign: 'text-start'}) ? activeClass : inactiveClass ]">
                <i class="fa fa-align-left"></i>
            </button>
            <button type="button" @click="editor.chain().focus().setTextAlign('text-center').run()" :class="[ baseClass, editor.isActive({textAlign: 'text-center'}) ? activeClass : inactiveClass ]">
                <i class="fa fa-align-center"></i>
            </button>
            <button type="button" @click="editor.chain().focus().setTextAlign('text-end').run()" :class="[ baseClass, editor.isActive({textAlign: 'text-end'}) ? activeClass : inactiveClass ]">
                <i class="fa fa-align-right"></i>
            </button>
            <button type="button" @click="setLink" :class="[ baseClass, editor.isActive('link') ? activeClass : inactiveClass ]">
                <i class="fa fa-link"></i>
            </button>
            <button type="button" @click="setImage" :class="[ baseClass, editor.isActive('image') ? activeClass : inactiveClass ]">
                <i class="fa fa-image"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="[ baseClass, editor.isActive('bulletList') ? activeClass : inactiveClass ]">
                <i class="fa fa-list"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="[ baseClass, editor.isActive('orderedList') ? activeClass : inactiveClass ]">
                <i class="fa fa-list-ol"></i>
            </button>
            <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="[ baseClass, editor.isActive('blockquote') ? activeClass : inactiveClass ]">
                <i class="fa fa-quote-right"></i> Blockquote
            </button>
            <!-- <button type="button" @click="editor.chain().focus().toggleCode().run()" :class="[ baseClass, editor.isActive('code') ? activeClass : inactiveClass ]">
                <i class="fa fa-code"></i>
            </button> -->
            <button type="button" @click="editor.chain().focus().unsetAllMarks().run()" :class="[baseClass, inactiveClass]">
                <i class="fa fa-remove-format"></i>
            </button>
            <!-- <button type="button" @click="editor.chain().focus().setHorizontalRule().run()"
            >
                Horizontale Linie
            </button> -->
            <!-- <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()" :class="[ baseClass, editor.isActive('codeBlock') ? activeClass : inactiveClass ]"
            >
                <i class="fa fa-code"></i> Codeblock
            </button> -->
            <!-- <button type="button" @click="editor.chain().focus().setHardBreak().run()" :class="[baseClass, inactiveClass]">
                Zeilenumbruch
            </button> -->
            <!-- <button type="button" @click="editor.chain().focus().clearNodes().run()"
            >
                clear nodes
            </button> -->

            <button type="button" @click="editor.chain().focus().undo().run()" :class="[baseClass, inactiveClass]">
                <i class="fa fa-undo"></i>
            </button>
            <button type="button" @click="editor.chain().focus().redo().run()" :class="[baseClass, inactiveClass]">
                <i class="fa fa-redo"></i>
            </button>

            <button v-if="peopleGroup" type="button" @click="setPerson" :class="[ baseClass, editor.isActive('personnode') ? activeClass : inactiveClass ]">
                <i class="fa fa-person"></i>
            </button>

            <button type="button"  :class="[baseClass, inactiveClass]"  @click="showTableButtons = !showTableButtons">
                <i class="fa fa-table"></i> <i class="fa fa-caret-down"></i>
            </button>

            <span v-show="showTableButtons">
                <button type="button" @click="editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()" :class="[baseClass, inactiveClass]">
                    Neue Tabelle
                </button>
                <button type="button" @click="editor.chain().focus().deleteTable().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-minus"></i> Tabelle
                </button>
                <button type="button" @click="editor.chain().focus().addColumnBefore().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-plus"></i> Spalte davor
                </button>
                <button type="button" @click="editor.chain().focus().addColumnAfter().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-plus"></i> Spalte danach
                </button>
                <button type="button" @click="editor.chain().focus().deleteColumn().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-minus"></i> Spalte
                </button>
                <button type="button" @click="editor.chain().focus().addRowBefore().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-plus"></i> Zeile davor
                </button>
                <button type="button" @click="editor.chain().focus().addRowAfter().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-plus"></i> Zeile danach
                </button>
                <button type="button" @click="editor.chain().focus().deleteRow().run()" :class="[baseClass, inactiveClass]">
                    <i class="fa fa-minus"></i> Zeile
                </button>
                <button type="button" @click="editor.chain().focus().mergeCells().run()" :class="[baseClass, inactiveClass]">
                    Vereine Zellen
                </button>
                <button type="button" @click="editor.chain().focus().splitCell().run()" :class="[baseClass, inactiveClass]">
                    Teile Zellen
                </button>
                <button type="button" @click="editor.chain().focus().toggleHeaderColumn().run()" :class="[baseClass, inactiveClass]">
                    Toggle Überschrift Spalte
                </button>
                <button type="button" @click="editor.chain().focus().toggleHeaderRow().run()" :class="[baseClass, inactiveClass]">
                    Toggle Überschrift Zeile
                </button>
                <button type="button" @click="editor.chain().focus().toggleHeaderCell().run()" :class="[baseClass, inactiveClass]">
                    Toggle Überschrift Zelle
                </button>
                <!-- <button type="button" @click="editor.chain().focus().mergeOrSplit().run()"
                >
                    mergeOrSplit
                </button> -->
                <!-- <button type="button" @click="editor.chain().focus().setCellAttribute('colspan', 2).run()"
                >
                    setCellAttribute
                </button> -->
                <!-- <button type="button" @click="editor.chain().focus().fixTables().run()"
                >
                    fixTables
                </button> -->
                <!-- <button type="button" @click="editor.chain().focus().goToNextCell().run()"
                >
                    goToNextCell
                </button> -->
                <!-- <button type="button" @click="editor.chain().focus().goToPreviousCell().run()"
                >
                    goToPreviousCell
                </button> -->
            </span>


        </div>

        <editor-content :editor="editor" class="position-relative" />

        <modal id="image_modal">
            <div class="modal-header">
                <h5 class="modal-title">Bild einfügen:</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <form @submit.prevent="insertImage()">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL:</label>
                        <input class="form-control"
                               type="text"
                               placeholder="URL"
                               id="image_url"
                               v-model="image_url">
                    </div>

                    <div class="row">
                        <div v-for="image in imagesProp" :key="image.id" class="col-md-6 p-1 d-flex align-items-center justify-content-center" :class="{'border border-2 border-success rounded' : image_url === `/storage/${image.path}`}">
                            <img :src="`/storage/${image.thump}`" class="preview-image" @click="image_url = `/storage/${image.path}`">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-success">
                        <i class="fa fa-plus" /> Hinzufügen
                    </button>
                    <button type="button"
                            class="btn btn-light border border-dark"
                            data-bs-dismiss="modal">
                        <i class="fa fa-times" /> Abbrechen
                    </button>
                </div>
            </form>
        </modal>

        <modal id="person_modal">
            <div class="modal-header">
                <h5 class="modal-title">Personen einfügen</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <form @submit.prevent="insertPerson()">
                <div class="modal-body" style="overflow-y: auto; max-height: 80vmin">
                    <div v-if="editor && editor.isActive('personnode')" class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="replaceSelection" v-model="replace_selection">
                        <label class="form-check-label" for="replaceSelection">Ersetzte Auswahl</label>
                    </div>
                    <div class="accordion" id="peopleList">
                        <div v-for="(members, personCategory, index) in peopleGroup" :key="index" class="accordion-item">
                            <h2 class="accordion-header" :id="'heading' + index">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse' + index" aria-expanded="false" :aria-controls="'collapse' + index">
                                    {{ucFirst(personCategory)}}
                                </button>
                            </h2>
                            <div :id="'collapse' + index" class="accordion-collapse collapse" :aria-labelledby="'heading' + index" data-bs-parent="#peopleList">
                                <div class="accordion-body">
                                    <div v-for="person in members" :key="person.id">
                                        <div class="row" @click="person.selected = !person.selected" style="cursor: pointer">
                                            <div class="col-md-11">
                                                <person :person="person"></person>
                                            </div>
                                            <div class="col-md-1">
                                                <i class="fa" :class="person.selected ? 'fa-check' : 'fa-times' "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-success">
                        <i class="fa fa-plus" /> Hinzufügen
                    </button>
                    <button type="button"
                            class="btn btn-light border border-dark"
                            data-bs-dismiss="modal">
                        <i class="fa fa-times" /> Abbrechen
                    </button>
                </div>
            </form>
        </modal>
    </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

import Link from '@tiptap/extension-link'
import Table from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableCell from '@tiptap/extension-table-cell'
import TableHeader from '@tiptap/extension-table-header'
import Underline from '@tiptap/extension-underline'
import TextAlign from './TextAlign.js'
import TiptapPerson from './TiptapPerson.js'
import TiptapImage from './TiptapImage.js'

import Person from './Person.vue'
import Modal from "./Modal.vue";

import { Modal as BootstrapModal } from "bootstrap"

export default {
  props: {
    modelValue: {
      default: "",
    },
    imagesProp: {
        required: true,
        type: Array,
        default: []
    },
    peopleGroupProp: {
        required: true,
        default: null,
    }
  },
  components: {
    EditorContent,
    Modal,
    Person,
  },
  data() {
    return {
      editor: null,
      activeClass: "btn-dark",
      inactiveClass: "btn-light border border-dark",
      baseClass: "btn btn-sm btn-light me-1 mb-1",
      showTableButtons: false,
      image_url: '',
      image_size: null,
      image_modal: null,
      person_modal: null,
      peopleGroup: this.peopleGroupProp,
      show_person_modal: false,
      replace_selection: false,
      selected: {

      }
    }
  },
  beforeMount() {
    this.resetPeopleSelection()

    this.editor = new Editor({
        content: this.modelValue,
        // content: this.modelValue,
        editorProps: {
            attributes: {
                class: 'form-control text-area mt-2',
            },
        },
        onUpdate: () => {
            this.$emit('update:modelValue', this.editor.getJSON())
        },
        extensions: [
            StarterKit.configure({
                mention: false,
                blockquote: {
                    HTMLAttributes: {
                        class: 'blockquote border-start border-3 ps-2'
                    }
                },
                code: {
                    HTMLAttributes: {
                        class: 'bg-light rounded p-1 m-1 font-monospace'
                    }
                },
                codeBlock: {
                    HTMLAttributes: {
                        class: 'bg-light rounded p-2 my-2 font-monospace lh-lg text-danger'
                    }
                },
            }),
            Link,
            Table.extend({
                addOptions() {
                    return {
                        ...this.parent?.(),
                        HTMLAttributes: {
                            class: 'table table-bordered'
                        },
                        resizable: false,
                    }
                },
            }),
            TableRow,
            TableCell,
            TableHeader,
            Underline,
            TextAlign.configure({
                types: ['heading', 'paragraph', 'image'],
                alignments: ['text-start', 'text-center', 'text-end'],
                defaultAlignment: 'text-start'
            }),
            TiptapImage,
            TiptapPerson.configure({
                people: Object.values(this.peopleGroupProp).flatMap(x => x),
            })
        ],
    })
  },
  mounted() {
    this.image_modal = BootstrapModal.getOrCreateInstance(document.getElementById('image_modal'))
    this.person_modal = BootstrapModal.getOrCreateInstance(document.getElementById('person_modal'))
  },
  methods: {
    ucFirst(string) {
       return string.charAt(0).toUpperCase() + string.slice(1)
    },
    setLink() {
      if(this.editor.isActive('link'))
      {
          this.editor.chain().focus().unsetLink().run()
          return
      }

      const url = window.prompt('URL')

      this.editor
        .chain()
        .focus()
        .extendMarkRange('link')
        .toggleLink({ href: url })
        .run()
    },
    setImage() {
        if(this.editor && this.editor.isActive('image'))
        {
            this.image_url = this.editor.getAttributes('image').src
            this.image_size = this.editor.getAttributes('image').size
        }
        this.image_modal.show()
    },
    insertImage() {
      if(!this.image_url) return

      this.editor
        .chain()
        .focus()
        .setImage({ src: this.image_url, size: this.image_size})
        .run()

      this.image_url = ''
      this.image_modal.hide()
    },
    resetPeopleSelection() {
        Object.keys(this.peopleGroup).forEach(key =>
            this.peopleGroup[key].forEach((person) => { person.selected = false; return person })
        )
    },
    setPerson() {
        this.show_person_modal = true
        this.person_modal.show()
    },
    insertPerson() {
        const people = Object.values(this.peopleGroup).flatMap(x => x).filter(p => p.selected)

        if(this.replace_selection)
        {
            this.editor
            .chain()
            .focus()
            .deleteSelection().run()
        }

        this.editor.chain().focus()
        .setPerson(people, this.replace_selection)
        .run()

        this.resetPeopleSelection()
        this.person_modal.hide()

        this.editor.chain().focus().run()
    }
  },
  watch: {
      modelValue(value) {
          if(value === null) this.editor.commands.clearContent()

//         const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

//         if (isSame) {
//             return
//         }

//         this.editor.commands.setContent(value, false)
      }
  },
  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>

<style lang="scss">
.preview-image {
    height: 200px;
}
.text-area {
    -moz-appearance: textfield-multiline;
    -webkit-appearance: textarea;
    min-height: 5rem;
    overflow: auto;
    padding: 0.5rem;
    resize: vertical;
}

.ProseMirror {

    .node-focus {
        .person {
            border: 1px solid black;
        }
    }

    table {
        td, th {
            position: relative;
        }
        .selectedCell:after {
          z-index: 2;
          position: absolute;
          content: "";
          left: 0; right: 0; top: 0; bottom: 0;
          background: rgba(200, 200, 255, 0.4);
          pointer-events: none;
        }

        .column-resize-handle {
          position: absolute;
          right: -2px;
          top: 0;
          bottom: -2px;
          width: 4px;
          background-color: #adf;
          pointer-events: none;
        }
    }
}
.resize-cursor {
  cursor: ew-resize;
  cursor: col-resize;
}
</style>