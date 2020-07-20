<template>
  <div>
    <Add ref="form_role"></Add>
    <List-Categorie v-on:show="show" class="mt-3"></List-Categorie>
  </div>
</template>
<script>
import Add from "./add";
import ListCategorie from "./list";
export default {
  name: "categories",
  components: {
    ListCategorie,
    Add
  },
  methods: {
    show(row) {
      this.$refs.form_role.show(row);
    }
  }
};
</script>
