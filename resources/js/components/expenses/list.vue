<template>
    <div>
        <div v-if="!status">
            <Loader></Loader>
        </div>
        <div v-else>
            <Search-Item titleinput="Buscar Gastos"></Search-Item>
            <button
                v-if="can('ver gastos generales')"
                @click="viewAll"
                class="btn btn-default btn-xs"
            >
                <i class="fi fi-nav-icon-grid"></i>
            </button>
            <div class="table-responsive mt-3">
                <v-table
                    :data="expenses"
                    :currentPage.sync="currentPage"
                    :filters="filters"
                    :pageSize="4"
                    @totalPagesChanged="totalPages = $event"
                    class="table table-striped"
                >
                    <thead slot="head">
                        <tr>
                            <th>Responsable</th>
                            <th>Tipo de gasto</th>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody slot="body" slot-scope="{ displayData }">
                        <tr v-for="(row, index) in displayData" :key="index">
                            <td>{{ row.user_name }} {{ row.surname }}</td>
                            <td>{{ row.type }}</td>
                            <td>{{ row.name }}</td>
                            <td>${{ row.amount | currency }}</td>
                            <td>
                                <button
                                    type="button"
                                    @click="$emit('show', row)"
                                    class="btn btn-warning btn-sm"
                                >
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
            viewallExpense: false,
            action: "",
            prefijo: "El gasto",
            currentPage: 1,
            totalPages: 0
        };
    },
    computed: {
        ...mapState(["filters", "expenses", "status", "urlexpenses"])
    },
    created() {
        this.getlist();
    },
    methods: {
        viewAll() {
            this.viewallExpense = !this.viewallExpense;
            this.getlist();
        },
        getlist() {
            if (this.viewallExpense) {
                this.$store.dispatch("Expenseactions");
            } else {
                this.$store.dispatch("ExpenseOneactions");
            }
        }
    }
};
</script>
