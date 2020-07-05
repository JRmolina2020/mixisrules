import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        filters: {
            data: { value: "", keys: ["name", "surname", "email"] }
        },
        users: [],
        roles: [],
        permissions: [],
        categories: [],
        products: [],
        persons: [],
        departaments: [],
        cities: [],
        status: false,
        urlusers: "api/users/",
        urlroles: "api/roles/",
        urlpermissions: "api/permissions/",
        urlcategories: "api/categories/",
        urlproducts: "api/products/",
        urlpersons: "api/persons/",
        urldepartaments: "api/departaments/",
        urlcities: "api/cities/"
    },
    mutations: {
        Usermutations(state, item) {
            state.users = item;
        },
        Rolemutations(state, item) {
            state.roles = item;
        },
        Permissionmutations(state, item) {
            state.permissions = item;
        },
        Categoriemutations(state, item) {
            state.categories = item;
        },
        Productmutations(state, item) {
            state.products = item;
        },
        Personmutations(state, item) {
            state.persons = item;
        },
        Departamentmutations(state, item) {
            state.departaments = item;
        },
        Citymutations(state, item) {
            state.cities = item;
        }
    },
    actions: {
        async Useractions({ commit, state }) {
            try {
                let response = await axios.get(state.urlusers);
                commit("Usermutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Roleactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlroles);
                commit("Rolemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Permissionsactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlpermissions);
                commit("Permissionmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Categorieactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlcategories);
                commit("Categoriemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Productactions({ commit, state }) {
            try {
                let response = await axios.get(`${state.urlproducts}`);
                commit("Productmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Personactions({ commit, state }) {
            try {
                let response = await axios.get(`${state.urlpersons}`);
                commit("Personmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Departamentactions({ commit, state }) {
            try {
                let response = await axios.get(`${state.urldepartaments}`);
                commit("Departamentmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Cityactions({ commit, state }, id) {
            try {
                let response = await axios.get(`${state.urlcities}${id}`);
                commit("Citymutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        }
    }
});
