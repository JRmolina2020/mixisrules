<template>
    <div>
        <Modal-Resource v-on:clear="clear" title="Registro de gastos diarios">
            <section v-if="!form.id" slot="title">Registro de gastos</section>
            <section v-else slot="title">Editar gastos</section>
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
            <section slot="titlebutton">Registrar gastos</section>
            <section slot="body">
                <form
                    method="POST"
                    @submit.prevent="add(form.id, action)"
                    autocomplete="off"
                >
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for>Tipo de gatos</label>
                                <select
                                    class="form-control form-control-sm"
                                    v-model="form.type"
                                    name="tipo"
                                >
                                    <option value="Gasto fijo"
                                        >Gasto fijo</option
                                    >
                                    <option value="Gasto variable"
                                        >Gasto variable</option
                                    >
                                    <option value="Gasto hormiga"
                                        >Gasto hormiga</option
                                    >
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                                    placeholder="Nombre de la categoria a registrar"
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
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for>Monto</label>
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
                                            submitted && errors.has('monto')
                                    }"
                                    v-model="form.amount"
                                    name="monto"
                                />
                                <div
                                    v-if="submitted && errors.has('monto')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("monto") }}
                                </div>
                            </div>
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
            action: "ExpenseOneactions",
            url: "api/expenses",
            submitted: true,
            form: {
                id: null,
                type: null,
                name: null,
                amount: 0
            }
        };
    },
    computed: {},
    methods: {
        show(row) {
            this.form.id = row.id;
            this.form.type = row.type;
            this.form.name = row.name;
            this.form.amount = row.amount;
            this.status = false;
            $("#model").modal("show");
        },
        clear() {
            this.form.id = null;
            this.form.type = "Gasto fijo";
            this.form.name = null;
            this.form.amount = 0;
            this.status = false;
            this.$validator.reset();
        }
    }
};
</script>
