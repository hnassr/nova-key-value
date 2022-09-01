<template>
  <PanelItem :index="index" :field="field">
    <template v-if="field.value != null" #value>
      <div v-if="rows.length === 0">—</div>
      <FormKeyValueTable
        v-if="rows.length > 0"
        :edit-mode="false"
        class="overflow-hidden"
      >
        <FormKeyValueHeader
          :key-label="field.keyLabel ?? 'Key'"
          :value-label="field.valueLabel ?? 'Value'"
        />

        <div
          class="bg-gray-50 dark:bg-gray-700 overflow-hidden key-value-items"
        >
          <FormKeyValueItem
            v-for="(row, index) in rows"
            :index="index"
            :item="row"
            :disabled="true"
            :key="row.key"
          />
        </div>
      </FormKeyValueTable>
    </template>
  </PanelItem>
</template>

<script>
  
export default {
  props: ["resource", "resourceName", "resourceId", "field"],

  data() {
    return {
      rows: [],
    };
  },

  mounted() {
    if (Array.isArray(JSON.parse(this.field.value))) {
      this.rows = JSON.parse(this.field.value);
    }
  },
};
</script>
