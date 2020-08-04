<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn bg-secondary btn-sm"
      data-toggle="modal"
      :data-target="'#model' + row.id"
      @click="getlistProduct"
    >Detalle</button>

    <div
      class="modal fade"
      :id="'model' + row.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <v-table
              :data="entriesdetails"
              :currentPage.sync="currentPage"
              :filters="filters"
              :pageSize="10"
              @totalPagesChanged="totalPages = $event"
              class="table mt-3"
            >
              >
              <thead slot="head">
                <tr class="table-warning">
                  <th>Codigo</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody slot="body" slot-scope="{ displayData }">
                <tr v-for="(item, index) in displayData" :key="index" class="table-light">
                  <td>{{item.code}}</td>
                  <td>{{item.name}}</td>
                  <td>{{item.quantity}}</td>
                  <td>${{item.price | currency}}</td>
                  <td>${{item.subtotal | currency}}</td>
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
            <div class="col-lg-12 mt-3">
              <h5>TOTAL</h5>
              ${{ row.total|currency }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SearchItem from "../utilities/search";
import { mapState } from "vuex";
export default {
  name: "modaldetails",
  props: {
    row: {
      type: Object,
      required: true,
    },
  },
  components: {
    SearchItem,
  },
  data() {
    return {
      currentPage: 1,
      totalPages: 0,
    };
  },

  computed: {
    ...mapState(["filters", "entriesdetails", "urlentriesdetail"]),
  },
  methods: {
    getlistProduct() {
      this.$store.dispatch("EntriesDetailsactions", this.row.id);
    },
  },
};
</script>