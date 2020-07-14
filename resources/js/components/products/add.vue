<template>
    <div>
        <Modal-Resource v-on:clear="clear" title="Registro de productos">
            <section v-if="!form.id" slot="title">
                Registro de productos
            </section>
            <section v-else slot="title">Editar producto</section>
            <section slot="closebtn">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </section>
            <section slot="titlebutton">Registrar producto</section>
            <section slot="body">
                <form
                    method="POST"
                    @submit.prevent="add(form.id, action)"
                    autocomplete="off"
                >
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Codigo</label>
                                <input
                                    type="text"
                                    v-validate="'required|max:7|min:3'"
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('codigo')
                                    }"
                                    placeholder="Codigo del producto"
                                    v-model="form.code"
                                    name="codigo"
                                />
                                <div
                                    v-if="submitted && errors.has('codigo')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("codigo") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Nombre</label>
                                <input
                                    type="text"
                                    v-validate="'required|max:30|min:3'"
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('nombre')
                                    }"
                                    placeholder="Nombre del producto a registrar"
                                    v-model="form.name"
                                    name="nombre"
                                />
                                <div
                                    v-if="submitted && errors.has('nombre')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("nombre") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Categoria</label>
                                <select
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('categoria')
                                    }"
                                    name="categoria"
                                    id="categoria"
                                    v-model="form.categorie_id"
                                    v-validate="'required'"
                                >
                                    <option
                                        v-for="(item, index) in categories"
                                        :value="item.id"
                                        :key="index"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <div
                                    v-if="submitted && errors.has('categoria')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("categoria") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Precio de venta</label>
                                <currency-input
                                    v-validate="'|required'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en'
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('precio')
                                    }"
                                    v-model="form.sale_price"
                                    name="precio"
                                />
                                <div
                                    v-if="submitted && errors.has('precio')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("precio") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Fecha de vencimiento</label>
                                <input
                                    v-model="form.expiration"
                                    class="form-control form-control-sm"
                                    type="date"
                                />
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for=""> Unidad de medida</label>
                                <select
                                    class="form-control form-control-sm"
                                    v-model="form.unit"
                                >
                                    <option
                                        v-for="(item, index) in measures"
                                        :key="index"
                                        >{{ item.name }}</option
                                    >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for>Descripción</label>
                        <textarea
                            rows="3"
                            v-validate="'required|max:100|min:5'"
                            class="form-control form-control-sm"
                            :class="{
                                'is-invalid':
                                    submitted && errors.has('descripción')
                            }"
                            v-model="form.description"
                            name="descripción"
                        />
                        <div
                            v-if="submitted && errors.has('descripción')"
                            class="invalid-feedback"
                        >
                            {{ errors.first("descripción") }}
                        </div>
                    </div>

                    <button
                        :hidden="errors.any()"
                        type="submit"
                        v-bind:class="{
                            'btn btn-outline-primary ': !this.form.id,
                            'btn btn-outline-danger ': this.form.id
                        }"
                    >
                        <i
                            v-bind:class="{
                                'fi fi-wink': !this.form.id,
                                'fi fi-like': this.form.id
                            }"
                            aria-hidden="true"
                        ></i>
                    </button>
                </form>
            </section>
        </Modal-Resource>
    </div>
</template>
<script>
import ModalResource from "../utilities/modal.vue";
import { mapState } from "vuex";
import add from "../../mixins/add";
export default {
    $_veeValidate: {
        validator: "new"
    },
    name: "add",
    mixins: [add],
    components: {
        ModalResource
    },
    data() {
        return {
            status: false,
            action: "Productactions",
            url: "api/products",
            submitted: true,
            form: {
                id: null,
                code: null,
                name: null,
                categorie_id: null,
                sale_price: 0,
                description: null,
                expiration: null,
                unit: "und"
            }
        };
    },
    computed: {
        ...mapState(["categories", "measures"])
    },
    created() {
        this.getlistData();
    },

    methods: {
        getlistData() {
            this.$store.dispatch("Categorieactions");
            this.$store.dispatch("Measureactions");
        },
        show(row) {
            this.form.categorie_id = row.idc;
            this.form.code = row.code;
            this.form.name = row.name;
            this.form.sale_price = row.sale_price;
            this.form.description = row.description;
            this.form.expiration = row.expiration;
            this.form.unit = row.unit;
            this.form.id = row.id;
            this.status = false;
            $("#model").modal("show");
        },
        clear() {
            this.form.id = null;
            this.form.categorie_id = null;
            this.form.code = null;
            this.form.name = null;
            this.form.sale_price = 0;
            this.form.description = null;
            this.form.expiration = null;
            this.formunit = "und";
            this.status = false;
            this.$validator.reset();
        }
    }
};
</script>
