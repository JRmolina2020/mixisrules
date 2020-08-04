<template>
  <div class="col-lg-2">
    <label>Productos</label>
    <button
      type="button"
      class="btn btn-primary btn-md"
      data-toggle="modal"
      data-target="#modelId"
    >Launch</button>
    <div
      class="modal fade"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <Search-Item titleinput="Buscar Productos"></Search-Item>
            <v-table
              :data="products"
              :currentPage.sync="currentPage"
              :filters="filters"
              :pageSize="4"
              @totalPagesChanged="totalPages = $event"
              class="table table-striped"
            >
              <thead slot="head">
                <tr>
                  <th>Codigo</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio actual</th>
                  <th></th>
                </tr>
              </thead>
              <tbody slot="body" slot-scope="{ displayData }">
                <tr v-for="(row, index) in displayData" :key="index">
                  <td scope="row">{{row.code}}</td>
                  <td>{{row.name}}</td>
                  <td>{{row.stock}}</td>
                  <td>${{row.purchase_price |currency}}</td>
                  <td>
                    <button
                      type="button"
                      @click="$emit('addproduct',row)"
                      class="btn bg-purple btn-sm"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </v-table>
            <div class="box-footer clearfix">
              <smart-pagination
                :currentPage.sync="currentPage"
                :maxPageLinks="6"
                :totalPages="totalPages"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import SearchItem from "../utilities/search";
export default {
  data() {
    return {
      currentPage: 1,
      totalPages: 0,
    };
  },
  name: "ProductsModal",
  components: {
    SearchItem,
  },
  computed: {
    ...mapState(["filters", "products"]),
  },
  created() {
    this.getAllproduct();
  },
  methods: {
    getAllproduct() {
      this.$store.dispatch("Productactions");
    },
  },
};
</script>