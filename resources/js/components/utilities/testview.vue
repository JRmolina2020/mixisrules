<template>
  <div>
    <button
      type="button"
      class="btn btn-primary btn-sm"
      data-toggle="modal"
      :data-target="'#model' + row.id"
    >
      <i class="fi fi-email"></i>
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
              <strong>INFORMACIÓN DE:</strong>
              {{row.name}} {{row.surname}}
            </p>
            <p class="mt-3">
              <i class="fi fi-email"></i>
              <strong>EMAIL:</strong>
              {{ row.email }}
            </p>
            <p v-if="row.telephone">
              <i class="fi fi-mobile"></i>
              <strong>TEL:</strong>
              {{ row.telephone }}
            </p>
            <p v-if="row.direction">
              <i class="fi fi-map-marker-alt"></i>
              <strong>DIR:</strong>
              {{ row.direction }}
            </p>
            <p v-if="row.type_person">
              <i class="fi fi-male"></i>
              <strong>NEGOCIO:</strong>
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