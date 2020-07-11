<template>
  <div>
    <div v-if="!status">
      <Loader></Loader>
    </div>
    <div v-else>
      <Search-Item titleinput="Buscar proveedores"></Search-Item>
      <div class="table-responsive mt-3">
        <v-table
          :data="providers"
          :currentPage.sync="currentPage"
          :filters="filters"
          :pageSize="4"
          @totalPagesChanged="totalPages = $event"
          class="table table-striped"
        >
          <thead slot="head">
            <tr>
              <th>TD</th>
              <th>Documento</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Información</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody slot="body" slot-scope="{ displayData }">
            <tr v-for="(row, index) in displayData" :key="index">
              <td>{{ row.type_document }}</td>
              <td>
                {{ row.document }}
                <strong>{{ row.prefix }}</strong>
              </td>
              <td>{{ row.name }}</td>
              <td>{{ row.surname }}</td>
              <td>
                <Test-View v-bind:row="row"></Test-View>
              </td>
              <td>
                <button type="button" @click="$emit('show', row)" class="btn btn-warning btn-sm">
                  <i class="fi fi-eye"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
      <div class="box-footer clearfix">
        <smart-pagination
          :currentPage.sync="currentPage"
          :maxPageLinks="6"
          :totalPages="totalPages"
        />
      </div>
    </div>
  </div>
</template>
<script>
import SearchItem from "../utilities/search";
import Loader from "../utilities/loader";
import { mapState } from "vuex";
import TestView from "../utilities/testview";
export default {
  name: "list",
  components: {
    SearchItem,
    Loader,
    TestView
  },
  data() {
    return {
      currentPage: 1,
      totalPages: 0
    };
  },
  computed: {
    ...mapState(["filters", "providers", "status"])
  },
  created() {
    this.getlist();
  },
  methods: {
    getlist() {
      this.$store.dispatch("Provideractions");
    }
  }
};
</script>
