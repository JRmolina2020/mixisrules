<template>
  <div>
    <button
      type="button"
      class="btn btn-default btn-sm"
      data-toggle="modal"
      :data-target="'#model' + row.id"
    >
      <i class="fi fi-angle-dobule-up"></i>
    </button>
    <div
      class="modal fade"
      :id="'model' + row.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p class="text-center">
              <strong>Informacion de:</strong>
              {{row.name}} {{row.surname}}
            </p>
            <p class="mt-3">
              <i class="fi fi-email"></i>
              <strong>Correo:</strong>
              {{ row.email }}
            </p>
            <p v-if="row.telephone">
              <i class="fi fi-mobile"></i>
              <strong>Telefono:</strong>
              {{ row.telephone }}
            </p>
            <p v-if="row.direction">
              <i class="fi fi-map-marker-alt"></i>
              <strong>Dirección:</strong>
              {{ row.direction }} - {{ row.name_city }}
            </p>
            <p v-if="row.type_person">
              <i class="fi fi-male"></i>
              <strong>Negocio:</strong>
              {{ row.business_name }}
            </p>
            <div v-if="row.type_person">
              <p v-if="row.type_person==1">
                <span class="badge bg-primary">P.juridica , responsable de iva</span>
              </p>
              <p v-else>
                <span class="badge bg-primary">P.natural ,no responsable de iva</span>
              </p>
            </div>
            <p v-if="row.company_name">
              <i class="fi fi-keyboard"></i>
              <strong>EMPRESA:</strong>
              {{ row.company_name }}
            </p>
            <p v-if="row.services">
              <i class="fi fi-redis"></i>
              <strong>Servicio que ofrece la empresa:</strong>
              {{ row.services }}
            </p>
            <p v-if="row.landline">
              <i class="fi fi-male"></i>
              <strong>Telefono fijo</strong>
              {{ row.landline }}
            </p>
            <p v-if="row.banking_entity">
              <strong>Información de la cuenta</strong>
            </p>
            <div class="table-responsive">
              <table class="table" v-if="row.banking_entity">
                <thead class="thead-dark">
                  <tr>
                    <th>Entidad bancaria</th>
                    <th>Tipo de cuenta</th>
                    <th>Número de cuenta</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td scope="row">{{row.banking_entity}}</td>
                    <td>{{row.account_type}}</td>
                    <td>{{row.account_number}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    row: {
      type: Object,
      required: true
    }
  }
};
</script>