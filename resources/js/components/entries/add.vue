<template>
  <div>
    <form method="POST" @submit.prevent="add_entry()" autocomplete="off">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for>Proveedor</label>
            <select
              v-model="form.provider_id"
              name="proveedor"
              v-validate="'required'"
              class="form-control"
              :class="{
                                'is-invalid': submitted && errors.has('proveedor')
                            }"
            >
              <option v-for="(item, index) in providers" :value="item.id" :key="index">{{item.name}}</option>
            </select>
            <div
              v-if="submitted && errors.has('proveedor')"
              class="invalid-feedback"
            >{{ errors.first("proveedor") }}</div>
          </div>
        </div>
        <Products-Modal v-on:addproduct="addproduct"></Products-Modal>
      </div>
      <div class="mt-5">
        <div class="row table-responsive-sm">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in form.products" :key="index">
                <td>{{ item.code }}</td>
                <td>{{ item.name }}</td>
                <td>${{item.price | currency}}</td>
                <td style="width:10%;">
                  <input
                    type="number"
                    name="cantidad"
                    v-validate="'required'"
                    class="form-control"
                    :class="{
                                'is-invalid': submitted && errors.has('cantidad')
                            }"
                    v-model="quantity_aux[index]"
                    @change="increment(index)"
                  />
                  <div
                    v-if="submitted && errors.has('cantidad')"
                    class="invalid-feedback"
                  >{{ errors.first("cantidad") }}</div>
                </td>
                <td class="bg-success">${{ item.quantity*item.price | currency}}</td>
                <td>
                  <button type="button" @click="remove(index)" class="btn btn-danger btn-xs">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="form-group">
            <h3>${{ form.total | currency}}</h3>
            <small id="helpId" class="form-text text-muted">Total compra</small>
          </div>
        </div>
      </div>
      <div v-if="form.products.length==0"></div>
      <div v-else>
        <button class="btn btn-outline-primary" :hidden="errors.any()" type="submit">Guardar</button>
      </div>
    </form>
  </div>
</template>
<script>
import { mapState } from "vuex";
import ProductsModal from "./productsModal";
export default {
  name: "add",

  components: {
    ProductsModal,
  },
  data() {
    return {
      submitted: true,
      quantity_aux: [],
      url: "api/entries",
      product: {
        quantity: 0,
      },
      form: {
        provider_id: null,
        total: 0,
        products: [],
      },
    };
  },
  computed: {
    ...mapState(["providers"]),
  },

  created() {
    this.getproviders();
  },
  methods: {
    getproviders() {
      this.$store.dispatch("Provideractions");
    },
    addproduct(row) {
      this.form.products.push({
        product_id: row.id,
        code: row.code,
        name: row.name,
        quantity: 1,
        price: row.purchase_price,
        subtotal: 0,
      });
    },
    calculartotal() {
      var total = 0;
      for (let i = 0; i < this.form.products.length; i++) {
        var total = total + this.form.products[i].subtotal;
      }
      this.form.total = total;
    },
    increment(i) {
      this.form.products[i].quantity = this.quantity_aux[i];
      this.form.products[i].subtotal =
        this.form.products[i].quantity * this.form.products[i].price;
      this.calculartotal();
    },
    remove(i) {
      this.form.products.splice(i, 1);
    },

    add_entry() {
      this.$validator.validate().then((valid) => {
        if (valid) {
          this.calculartotal();
          axios
            .post(this.url, this.form)
            .then((res) => {
              this.$emit("movetabs");
              this.$store.dispatch("Entriesactions");
              this.$store.dispatch("Productactions");
              console.log(res);
              this.clear();
            })
            .catch((err) => console.log(err));
        }
      });
    },
    clear() {
      this.form.provider_id = null;
      this.form.total = null;
      this.form.cantidad = [1];
      this.form.products = [];
    },
  },
};
</script>