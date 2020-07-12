<template>
  <div>
    <Modal-Resource v-on:clear="clear" title="Registro de roles">
      <section v-if="!form.id" slot="title">Registro de proveedores</section>
      <section v-else slot="title">Editar provedores</section>
      <section slot="closebtn">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
      <section slot="titlebutton">Registrar proveedores</section>
      <section slot="body">
        <form method="POST" @submit.prevent="add(form.id, action)" autocomplete="off">
          <form-wizard ref="wizard" shape="tab" title subtitle color="#0982BB">
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
                    <label for>Nombre de la empresa</label>
                    <input
                      type="text"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has(
                                                        'nombre de la empresa'
                                                    )
                                            }"
                      placeholder="Nombre de la empresa"
                      v-model="form.company_name"
                      name="nombre de la empresa"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has(
                                                        'nombre de la empresa'
                                                    )
                                            "
                      class="invalid-feedback"
                    >
                      {{
                      errors.first(
                      "nombre de la empresa"
                      )
                      }}
                    </div>
                  </div>
                </div>
              </div>
            </tab-content>
            <tab-content title="Empresa" icon="fi fi-keyboard">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Tipo de servicio</label>
                    <input
                      type="text"
                      v-validate="'required|max:30|min:3'"
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has(
                                                        'servicio de la empresa'
                                                    )
                                            }"
                      placeholder="Servicio de la empresa"
                      v-model="form.services"
                      name="servicio de la empresa"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has(
                                                        'servicio de la empresa'
                                                    )
                                            "
                      class="invalid-feedback"
                    >
                      {{
                      errors.first(
                      "servicio de la empresa"
                      )
                      }}
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Telefono fijo</label>
                    <input
                      type="number"
                      v-validate="
                                               'required|between:1,10000000000'
                                            "
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('telefono fijo')
                                            }"
                      v-model="form.landline"
                      name="telefono fijo"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('telefono fijo')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("telefono fijo") }}</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Entidad bancaria</label>
                    <select
                      class="form-control form-control-sm"
                      name="entidad"
                      v-model="form.banking_entity"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('entidad')
                                            }"
                      v-validate="'required|'"
                    >
                      <option value="Banco agrario">Banco agrario</option>
                      <option value="Banco AV villas">Banco AV Villas</option>
                      <option value="Banco caja social">Banco caja social</option>
                      <option value="Banco de occidente">Banco de occidente</option>
                      <option value="Bancolombia">Bancolombia</option>
                      <option value="Bancolombia a la mano">Bancolombia a la mano</option>
                      <option value="Banco popular">Banco Popular</option>
                      <option value="BBVA">BBVA</option>
                      <option value="Banco bogóta">Banco de bogóta</option>
                      <option value="Colpatria">Colpatria</option>
                      <option value="Davivienda">Davivienda</option>
                      <option value="Nequi">Nequi</option>
                      <option value="Otro">Otro</option>
                    </select>
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('entidad')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("entidad") }}</div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for>Tipo de cuenta</label>
                    <select
                      class="form-control form-control-sm"
                      name="tipo de cuenta"
                      v-model="form.account_type"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('tipo de cuenta')
                                            }"
                      v-validate="'required|'"
                    >
                      <option value="C.corriente">C.corriente</option>
                      <option value="C.ahorro">C.ahorro</option>
                      <option value="Banco agrario">Cuenta de nómina</option>
                      <option value="Otro">Otro</option>
                    </select>
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('tipo de cuenta')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("tipo de cuenta") }}</div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for>Número de cuenta</label>
                    <input
                      type="number"
                      v-validate="
                                              'required|between:1,10000000000'
                                            "
                      class="form-control form-control-sm"
                      :class="{
                                                'is-invalid':
                                                    submitted &&
                                                    errors.has('número de cuenta')
                                            }"
                      v-model="form.account_number"
                      name="número de cuenta"
                    />
                    <div
                      v-if="
                                                submitted &&
                                                    errors.has('número de cuenta')
                                            "
                      class="invalid-feedback"
                    >{{ errors.first("número de cuenta") }}</div>
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
              class="btn btn-outline-primary"
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
      action: "Provideractions",
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
        is_client: 0,
        name: "",
        surname: "",
        email: "",
        telephone: "",
        departament_id: "",
        city_id: "",
        direction: "",
        company_name: "",
        services: "",
        landline: "55555",
        banking_entity: "",
        account_type: "",
        account_number: "11111"
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
      this.form.document = row.document;
      this.form.prefix = row.prefix;
      this.form.email = row.email;
      this.form.telephone = row.telephone;
      this.form.departament_id = row.departament_id;
      this.form.city_id = row.city_id;
      this.form.direction = row.direction;
      this.form.company_name = row.company_name;
      this.form.services = row.services;
      this.form.landline = row.landline;
      this.form.banking_entity = row.banking_entity;
      this.form.account_type = row.account_type;
      this.form.account_number = row.account_number;
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
      } else {
        this.isnit = false;
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
      this.form.company_name = null;
      this.form.services = null;
      this.form.landline = "55555";
      this.form.banking_entity = null;
      this.form.account_type = null;
      this.form.account_number = "11111";
      this.$validator.reset();
      this.$refs.wizard.changeTab(0, 0);
      this.status = false;
    }
  }
};
</script>
