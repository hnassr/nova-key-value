<template>
  <DefaultField
    :field="currentField"
    :errors="errors"
    :full-width-content="mode === 'modal'"
    :show-help-text="showHelpText"
  >
    <template #field>
      <draggable
        v-model="rows"
        :disabled="false"
        class="list-group grid justify-center"
        ghost-class="ghost-card"
        :item-key="guid()"
      >
        >
        <template #item="{ element }">
          <div
            :ref="element.key"
            class="flex cursor-move pl-12 mt-3 px-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
          >
            <div class="w-3/4 py-3 mr-1">
              <input
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                placeholder="Key"
                v-model="element.key"
              />
            </div>
            <div class="w-3/4 py-3">
              <input
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                placeholder="Value"
                v-model="element.value"
              />
            </div>

            <div class="w-1/4 py-3 items-center">
              <a
                @click="removeRow(index)"
                title="Delete"
                class="appearance-none cursor-pointer text-70 hover:text-primary mr-3"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  aria-labelledby="delete"
                  role="presentation"
                  class="fill-current align-middle ml-4 mt-1 inline text-red-600 hover:text-red-800 cursor-pointer"
                >
                  <path
                    fill-rule="nonzero"
                    d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"
                  ></path>
                </svg>
              </a>
            </div>
          </div>
        </template>
        <template #footer>
          <button
            @click="addRow"
            :dusk="`${field.attribute}-add-key-value`"
            type="button"
            class="cursor-pointer focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 focus:ring-offset-4 dark:focus:ring-offset-gray-800 rounded-lg mx-auto hover:text-primary-600 text-primary-500 font-bold link-default mt-3 px-3 rounded-b-lg flex items-center"
          >
            <Icon type="plus-circle" />
          </button>
        </template>
      </draggable>

      <!-- <div>
        <button
          @click="addRow"
          :dusk="`${field.attribute}-add-key-value`"
          type="button"
          class="cursor-pointer focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 focus:ring-offset-4 dark:focus:ring-offset-gray-800 rounded-lg mx-auto hover:text-primary-600 text-primary-500 font-bold link-default mt-3 px-3 rounded-b-lg flex items-center"
        >
          <Icon type="plus-circle" />
        </button>
      </div> -->

      <p v-if="hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from "laravel-nova";
import draggable from "vuedraggable";

export default {
  mixins: [DependentFormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  components: {
    draggable,
  },

  data() {
    return {
      rows: [],
    };
  },

  mounted() {
    if (!this.rows.length) {
      this.addRow();
    }
    if (Array.isArray(JSON.parse(this.value))) {
      this.rows = JSON.parse(this.value);
    }
    //console.log(this.guid());
  },

  methods: {
    addRow() {
      this.rows.push({ key: null, value: null });
    },

    removeRow(index) {
      this.rows.splice(index, 1);
    },

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || "";
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || "");
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value) {
      this.value = value;
    },
    guid() {
      var S4 = function () {
        return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
      };
      return (
        S4() +
        S4() +
        "-" +
        S4() +
        "-" +
        S4() +
        "-" +
        S4() +
        "-" +
        S4() +
        S4() +
        S4()
      );
    },
  },

  watch: {
    rows: {
      handler(value) {
        value = _.filter(value, function(row) { return row.key && row.value; });
        this.value = JSON.stringify(value);
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
.buttons {
  margin-top: 35px;
}
.ghost-card {
  opacity: 0.5;
  background: #f7fafc;
  border: 1px solid #4299e1;
}
</style>
