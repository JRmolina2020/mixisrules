<template>
  <div>
    <Add ref="form_client"></Add>
    <List-Client v-on:show="show" class="mt-3"></List-Client>
  </div>
</template>
<script>
import Add from "./add";
import ListClient from "./list";
export default {
  name: "permissions",
  components: {
    ListClient,
    Add
  },
  methods: {
    show(row) {
      this.$refs.form_client.show(row);
    }
  }
};
</script>