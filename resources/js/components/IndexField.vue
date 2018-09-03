<template>
    <div>
        <span v-for="row in rows" class="rounded-full py-2 px-2 mr-1" style="background-color: #dae1e7;">
            <strong>{{ row.key }}:</strong> {{ row.value }}
        </span>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],

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
