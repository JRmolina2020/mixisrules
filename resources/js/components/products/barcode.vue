<template>
    <div>
        <button
            type="button"
            class="btn btn-default btn-sm"
            data-toggle="modal"
            :data-target="'#model' + row.id"
        >
            <i class="fi fi-shopping-barcode"></i>
        </button>
        <div
            class="modal fade"
            :id="'model' + row.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>nombre del producto : {{ row.name }}</p>
                        <div class="form-group">
                            <label for>Cantidad</label>
                            <input
                                v-model.number="form.cant"
                                type="number"
                                class="form-control form-control-sm"
                            />
                            <small class="form-text text-muted"
                                >cantidad de impresiones</small
                            >
                        </div>

                        <div class="row">
                            <div
                                class="col-lg-3"
                                v-for="index in increment"
                                :key="index"
                            >
                                <barcode :value="row.code"></barcode>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "barcodebarra",
    props: {
        row: {
            type: Object,
            required: true
        }
    },

    computed: {
        increment() {
            let number = this.form.cant;
            return number;
        }
    },
    data() {
        return {
            output: null,
            form: {
                cant: 0
            }
        };
    },
    methods: {
        print() {
            this.$htmlToPaper("printMe");
        }
    }
};
</script>
