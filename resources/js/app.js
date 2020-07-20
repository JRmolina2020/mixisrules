require("./bootstrap");
window.Vue = require("vue");
window.Axios = require("axios");
import store from "./store";
import SmartTable from "vuejs-smart-table";
import auth from "./mixins/Auth.js";
import LaravelPermissionToVueJS from "laravel-permission-to-vuejs";
import Swal from "sweetalert2";
window.Swal = Swal;
import VueBarcode from "@chenfengyuan/vue-barcode";
import VueCurrencyInput from "vue-currency-input";
import VueCurrencyFilter from "vue-currency-filter";
//start validate
import es from "vee-validate/dist/locale/es";
import VeeValidate, { Validator } from "vee-validate";

//end validate
//end import
//vue use
Vue.use(VueCurrencyInput);
Vue.use(VeeValidate);
Validator.localize("es", es);
Vue.use(SmartTable);
Vue.use(LaravelPermissionToVueJS);
Vue.use(VueCurrencyFilter);
Vue.component(VueBarcode.name, VueBarcode);
Vue.mixin(auth);

//end use
Vue.component("login", require("./components/login.vue").default);
Vue.component("users", require("./components/users/index.vue").default);
Vue.component("roles", require("./components/roles/index.vue").default);
Vue.component(
    "permissions",
    require("./components/permissions/index.vue").default
);
Vue.component("home_app", require("./components/indicatorHome.vue").default);
Vue.component("profile", require("./components/users/profile.vue").default);
Vue.component(
    "categories",
    require("./components/categories/index.vue").default
);
Vue.component("products", require("./components/products/index.vue").default);
Vue.component("clients", require("./components/clients/index.vue").default);
Vue.component("providers", require("./components/providers/index.vue").default);
Vue.component("expenses", require("./components/expenses/index.vue").default);
Vue.component("measures", require("./components/config/index.vue").default);
Vue.component("entry", require("./components/entry/index.vue").default);
const app = new Vue({
    el: "#app",
    store
});
