<template>
  <div>
    <Modal-Resource v-on:clear="clear" title="Registro de roles">
      <section v-if="!form.id" slot="title">Registro de clientes</section>
      <section v-else slot="title">Editar clientes</section>
      <section slot="closebtn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
      <section slot="titlebutton">Registrar clientes</section>
      <section slot="body">
        <form method="POST" @submit.prevent="add(form.id, action)" autocomplete="off">
          <form-wizard ref="wizard" shape="tab" title subtitle color="#605ca8">
            <tab-content startIndex="default" title="Información" icon="fi fi-persons">
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for>TD</label>
                    <select
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('tipo documento')
                                            }"
                      v-validate="'required|'"
                      @change="nitstatus"
                      v-model="form.type_document"
                      name="tipo documento"
                    >
                      <option value="TI">TI</option>
                      <option value="CC">CC</option>
                      <option value="NIT">NIT</option>
                    </select>
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('tipo documento')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("tipo documento") }}</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Documento</label>
                    <input
                      type="number"
                      v-validate="
                                                'required|between:1,10000000000'
                                            "
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('documento')
                                            }"
                      v-model="form.document"
                      name="documento"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('documento')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("documento") }}</div>
                  </div>
                </div>
                <div v-if="isnit" class="col-lg-3">
                  <div class="form-group">
                    <label for>PREFIJO</label>
                    <input
                      name="prefijo"
                      v-model="form.prefix"
                      v-validate="
                                                'required|max:3|min:1|between:1,999'
                                            "
                      type="text"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('prefijo')
                                            }"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('prefijo')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("prefijo") }}</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Nombre</label>
                    <input
                      type="text"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('nombre')
                                            }"
                      placeholder="Nombre"
                      v-model="form.name"
                      name="nombre"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('nombre')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("nombre") }}</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Apellido</label>
                    <input
                      type="text"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('apellido')
                                            }"
                      placeholder="Apellido"
                      v-model="form.surname"
                      name="apellido"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('apellido')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("apellido") }}</div>
                  </div>
                </div>
              </div>
            </tab-content>
            <tab-content title="Contacto" icon="fi fi-map-marker-alt">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Email</label>
                    <input
                      type="email"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('email')
                                            }"
                      placeholder="Email"
                      v-model="form.email"
                      name="email"
                    />
                    <div
                      v-if="
                                                submitted && errors.has('email')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("email") }}</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Telefono</label>
                    <input
                      type="number"
                      v-validate="
                                                'required|between:1,10000000000'
                                            "
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('telefono')
                                            }"
                      v-model="form.telephone"
                      name="telefono"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('telefono')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("telefono") }}</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for>Nombre del negocio</label>
                    <input
                      type="text"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has(
                                                        'nombre del negocio'
                                                    )
                                            }"
                      placeholder="Nombre del negocio"
                      v-model="form.business_name"
                      name="nombre del negocio"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has(
                                                        'nombre del negocio'
                                                    )
                                            "
                      class="invalid-feedback"
                    >
                      {{
                      errors.first(
                      "nombre del negocio"
                      )
                      }}
                    </div>
                  </div>
                </div>
              </div>
            </tab-content>
            <tab-content title="Ubicación" icon="fi fi-prescription">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Departamento</label>
                    <select
                      class="form-control"
                      name="departamento"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('departamento')
                                            }"
                      v-validate="'required|'"
                      @change="
                                                getcities(form.departament_id)
                                            "
                      v-model="form.departament_id"
                    >
                      <option
                        v-for="(item,
                                                index) in departaments"
                        :key="index"
                        :value="item.id"
                      >{{ item.name }}</option>
                    </select>
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('departamento')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("departamento") }}</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Municipio</label>
                    <model-list-select
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('municipio')
                                            }"
                      v-validate="'required|'"
                      :list="cities"
                      name="municipio"
                      v-model="form.city_id"
                      option-value="id"
                      option-text="name"
                      placeholder="select item"
                    ></model-list-select>
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('municipio')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("municipio") }}</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for>Direccíon</label>
                    <input
                      type="text"
                      v-validate="'required|max:40|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('dirección')
                                            }"
                      placeholder="Dirección"
                      v-model="form.direction"
                      name="dirección"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('dirección')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("dirección") }}</div>
                  </div>
                </div>
              </div>
            </tab-content>

            <button
              type="submit"
              :hidden="errors.any()"
              class="btn bg-purple btn-flat"
              slot="finish"
            >Guardar</button>
          </form-wizard>
        </form>
      </section>
    </Modal-Resource>
  </div>
</template>
<script>
import ModalResource from "../utilities/modal.vue";
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import { ModelListSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";
import { mapState } from "vuex";
import add from "../../mixins/add";

export default {
  $_veeValidate: {
    validator: "new"
  },
  name: "add",
  mixins: [add],
  components: {
    ModalResource,
    FormWizard,
    TabContent,
    ModelListSelect
  },
  data() {
    return {
      action: "Personactions",
      url: "api/persons",
      status: false,
      submitted: true,
      isnit: false,
      depid: null,
      form: {
        id: null,
        type_document: "",
        document: "",
        prefix: "",
        is_client: 1,
        name: "",
        surname: "",
        email: "",
        telephone: "",
        departament_id: "",
        city_id: "",
        direction: "",
        type_person: "",
        regimen_type: "",
        responsible_iva: "",
        business_name: "",
        tributary_information: "ZZZ"
      }
    };
  },
  computed: {
    ...mapState(["cities", "departaments"])
  },
  created() {
    this.getdepartaments();
  },
  methods: {
    show(row) {
      this.form.id = row.id;
      this.form.name = row.name;
      this.form.surname = row.surname;
      this.form.type_document = row.type_document;
      this.form.type_person = row.type_person;
      this.form.regimen_type = row.regimen_type;
      this.form.responsible_iva = row.responsible_iva;
      this.form.document = row.document;
      this.form.prefix = row.prefix;
      this.form.email = row.email;
      this.form.telephone = row.telephone;
      this.form.departament_id = row.departament_id;
      this.form.city_id = row.city_id;
      this.form.business_name = row.business_name;
      this.form.direction = row.direction;
      this.getdepartaments;
      this.getcities(this.form.departament_id);
      this.$refs.wizard.changeTab(0, 0);
      this.status = false;
      $("#model").modal("show");
    },

    getdepartaments() {
      this.$store.dispatch("Departamentactions");
    },
    getcities(id) {
      this.$store.dispatch("Cityactions", id);
    },
    nitstatus() {
      if (this.form.type_document == "NIT") {
        this.isnit = true;
        this.form.type_person = 1;
        this.form.regimen_type = 48;
        this.form.responsible_iva = 1;
      } else {
        this.isnit = false;
        this.form.type_person = 2;
        this.form.regimen_type = 49;
        this.form.responsible_iva = 0;
      }
    },
    clear() {
      this.form.id = null;
      this.form.type_document = null;
      this.form.document = null;
      this.form.prefix;
      this.form.name = null;
      this.form.surname = null;
      this.form.email = null;
      this.form.telephone = null;
      this.form.departament_id = null;
      this.form.city_id = null;
      this.form.direction = null;
      this.form.business_name = null;
      this.$validator.reset();
      this.$refs.wizard.changeTab(0, 0);
      this.status = false;
    }
  }
};
</script>
