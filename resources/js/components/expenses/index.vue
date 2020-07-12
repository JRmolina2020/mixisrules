<template>
    <div>
        <Add v-if="can('registrar gastos')" ref="form_role"></Add>
        <List-Expenses v-on:show="show" class="mt-3"></List-Expenses>
    </div>
</template>
<script>
import Add from "./add";
import ListExpenses from "./list";
export default {
    name: "expenses",
    components: {
        ListExpenses,
        Add
    },

    methods: {
        show(row) {
            this.$refs.form_role.show(row);
        }
    }
};
</script>
