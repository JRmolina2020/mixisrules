<template>
  <div>
    <div v-if="!status">
      <Loader></Loader>
    </div>
    <div v-else>
      <Search-Item titleinput="Buscar ingreso de mercancia"></Search-Item>
      <div class="table-responsive mt-3">
        <v-table
          :data="entries"
          :currentPage.sync="currentPage"
          :filters="filters"
          :pageSize="10"
          @totalPagesChanged="totalPages = $event"
          class="table table-striped"
        >
          <thead slot="head">
            <tr>
              <th>No.</th>
              <th>Proveedor</th>
              <th>Empleado</th>
              <th>Total</th>
              <th>Fecha de compra</th>
              <th>ver</th>
              <th>anular</th>
            </tr>
          </thead>
          <tbody slot="body" slot-scope="{ displayData }">
            <tr v-for="(row, index) in displayData" :key="index">
              <td>{{ row.id }}</td>
              <td>{{ row.provider_name}} {{ row.provider_surname }} - {{ row.company_name }}</td>
              <td>{{row.user_name}} {{row.user_surname}}</td>
              <td>{{row.total | currency}}</td>
              <td>{{row.created_at}}</td>
              <td>
                <Modal-Details v-bind:row="row"></Modal-Details>
              </td>
              <td>
                <button
                  type="button"
                  @click="thestatus(row, urlentry, prefijo)"
                  v-bind:class="{
                                        'btn btn-sm': true,
                                        'btn-success': row.status,
                                        'btn-danger': row.status == 0
                                    }"
                >
                  <i
                    :class="
                                            row.status
                                                ? 'fi fi-toggle-on'
                                                : 'fi fi-toggle-off'
                                        "
                    aria-hidden="true"
                  ></i>
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
import status from "../../mixins/status";
import ModalDetails from "./modaldetails";
export default {
  name: "list",
  components: {
    SearchItem,
    Loader,
    ModalDetails,
  },
  mixins: [status],
  data() {
    return {
      prefijo: "El ingreso de mercancia",
      currentPage: 1,
      totalPages: 0,
    };
  },
  computed: {
    ...mapState(["filters", "entries", "status", "urlentries"]),
  },
  created() {
    this.getlist();
  },
  methods: {
    getlist() {
      this.$store.dispatch("Entriesactions");
    },
  },
};
</script>
