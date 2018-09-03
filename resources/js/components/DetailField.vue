<template>
    <panel-item :field="field">
        <div v-if="field.value != null" slot="value">
            <div v-for="row in rows" class="flex">
                <span class="rounded-full py-2 px-0">
                    <strong>{{ row.key }}:</strong> {{ row.value }}
                </span>
            </div>
        </div>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    data() {
        return {
            rows: [],
        }
    },

    mounted() {
        if(Array.isArray(JSON.parse(this.field.value))) {
            this.rows = JSON.parse(this.field.value);
        }
    }
}
</script>
