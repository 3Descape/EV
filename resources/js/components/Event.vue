<template>
  <fieldset :disabled="isUpdating">
        <form class="row mb-3" @submit.prevent="save(modelValue)">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input type="text" v-model="modelValue.name" class="form-control" id="name" required>
                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('name')">
                    <ul class="m-0">
                        <li :key="error.name" v-for="error in errors.getError('name')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="location">Ort:</label>
                <input type="text" v-model="modelValue.location" class="form-control" id="location" required>
                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('location')">
                    <ul class="m-0">
                        <li :key="error.location" v-for="error in errors.getError('location')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3" v-if="!isArchived">
                <label for="date">Datum:</label>
                <date-input :default="modelValue.date" @date="syncDate"></date-input>
                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('date')">
                    <ul class="m-0">
                        <li :key="error.date" v-for="error in errors.getError('date')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="description">Beschreibung:</label>

                <text-area v-model="modelValue.markup" :images-prop="imagesProp" :people-group-prop="peopleGroupProp"></text-area>

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('markup')">
                    <ul class="m-0">
                        <li :key="error.markup" v-for="error in errors.getError('markup')">{{ error }}</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="category">Kategorie:</label>
                <select class="form-select" v-model="modelValue.event_category_id">
                    <option :value="null" disabled>Bitte wählen Sie eine Kategorie</option>
                    <option v-for="category in categories"
                            :value="category.id"
                            :key="category.id">
                        {{ category.name }}
                    </option>
                </select>

                <div class="alert alert-danger mt-2" role="alert" v-if="errors.hasError('event_category_id')">
                    <ul class="m-0">
                        <li :key="error.event_category_id" v-for="error in errors.getError('event_category_id')">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mb-3 d-flex">
                <slot name="footer" :redirect="redirect"></slot>
            </div>
        </form>
    </fieldset>
</template>

<script>
import DateInput from "./DateInput.vue"
import TextArea from "./Textarea.vue"

export default {
    components: {
        DateInput,
        TextArea,
    },
    props: {
        modelValue: {
            default: {},
        },
        errors: {
            required: true,
        },
        isArchived: {
            required: true,
        },
        isUpdating: {
            required: true,
        },
        categories: {
            required: true,
        },
        imagesProp: {
            required: true,
        },
        peopleGroupProp: {
            required: true,
        },
        save: {
            required: true,
        }
    },
    data() {
        return {
            redirect: this.isArchived ? route('event_archived_index') : route('event_future_index')
        }
    },
    watch: {
        modelValue: {
            handler(value)
            {
                this.$emit('update:modelValue', value)
            },
            deep: true,
        }
    },
    methods: {
        syncDate(date) {
            this.modelValue.date = date
        },
    }
}
</script>

<style>

</style>