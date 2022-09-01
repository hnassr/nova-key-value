<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex justify-end">
                <a @click="addRow" title="Add"
                        class="appearance-none cursor-pointer text-80 hover:text-primary mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" role="presentation" class="fill-current">
                        <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
                    </svg>
                </a>
            </div>
            <div class="flex" v-for="(row, index) in rows" :key="index">
                <div class="w-3/4 py-3 mr-1">
                    <input type="text"
                           class="w-full form-control form-input form-input-bordered"
                           :class="errorClasses"
                           placeholder="Key"
                           v-model="row.key"
                    />
                </div>
                <div class="w-3/4 py-3">
                    <input type="text"
                           class="w-full form-control form-input form-input-bordered"
                           :class="errorClasses"
                           placeholder="Value"
                           v-model="row.value"
                    />
                </div>
                <div class="w-1/4 py-3 items-center" style="text-align: right;">
                    <a @click="removeRow(index)" title="Delete"
                            class="appearance-none cursor-pointer text-70 hover:text-primary mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                             aria-labelledby="delete" role="presentation" class="fill-current">
                            <path fill-rule="nonzero"
                                  d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            rows: [],
        }
    },

    mounted() {
        if(!this.rows.length) {
            this.addRow();
        }
        if(Array.isArray(JSON.parse(this.value))) {
            this.rows = JSON.parse(this.value);
        }
    },

    methods: {
        addRow() {
            this.rows.push({key: null, value: null});
        },

        removeRow(index) {
            this.rows.splice(index, 1);
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
        }
    },

    watch: {
        rows: {
            handler(value) {
                this.value = JSON.stringify(value)
            },
            deep: true,
        }
    }
}
</script>
