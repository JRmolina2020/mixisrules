<template>
    <div>
        <div v-if="!status">
            <Loader></Loader>
        </div>
        <div v-else>
            <Search-Item titleinput="Buscar Productos"></Search-Item>
            <div class="table-responsive mt-3">
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
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Existencias</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody slot="body" slot-scope="{ displayData }">
                        <tr v-for="(row, index) in displayData" :key="index">
                            <td>{{ row.code }}</td>
                            <td>{{ row.name }}</td>
                            <td>{{ row.name_categorie }}</td>
                            <td>{{ row.sale_price }}</td>
                            <td v-if="row.stock == 0">
                                <span class="badge bg-danger">
                                    <i class="fi fi-frowning"></i> Agotado</span
                                >
                            </td>
                            <td v-else>{{ row.stock }}</td>
                            <td>
                                <button
                                    type="button"
                                    @click="$emit('show', row)"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fi fi-eye"></i>
                                </button>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    @click="
                                        thestatus(row, urlproducts, prefijo)
                                    "
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
export default {
    name: "list",
    components: {
        SearchItem,
        Loader
    },
    mixins: [status],
    data() {
        return {
            prefijo: "El producto",
            currentPage: 1,
            totalPages: 0
        };
    },
    computed: {
        ...mapState(["filters", "products", "status", "urlproducts"])
    },
    created() {
        this.getlist();
    },
    methods: {
        getlist(status) {
            this.$store.dispatch("Productactions");
        }
    }
};
</script>
