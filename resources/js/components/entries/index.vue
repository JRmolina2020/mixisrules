<template>
  <div>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#add">Agregar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#list">Listado</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane container active" id="add">
        <Add v-on:movetabs="movetabs"></Add>
      </div>
      <div class="tab-pane container fade" id="list">
        <List-Categorie class="mt-3"></List-Categorie>
      </div>
    </div>
  </div>
</template>
<script>
import Add from "./add";
import ListCategorie from "./list";
export default {
  name: "categories",
  components: {
    ListCategorie,
    Add,
  },
  methods: {
    movetabs() {
      $('.nav-tabs a[href="#list"]').tab("show");
    },
  },
};
</script>
