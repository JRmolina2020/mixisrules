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
        status: false,
        urlusers: "api/users/",
        urlroles: "api/roles/",
        urlpermissions: "api/permissions/",
        urlcategories: "api/categories/"
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
        }
    }
});
