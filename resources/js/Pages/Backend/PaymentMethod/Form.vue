<template>
  <div class="row">
    <div class="col">
      <div class="card p-3">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="">Bank</label>
              <input
                type="text"
                class="form-control"
                v-model="form.bank"
                placeholder="Cth : Bank"
              />
            </div>
            <div class="col-md-4 mb-3">
              <label for="">Nama</label>
              <input
                type="text"
                class="form-control"
                v-model="form.name"
                placeholder="Cth : Nama"
              />
            </div>
            <div class="col-md-4 mb-3">
              <label for="">Account No</label>
              <input
                type="number"
                class="form-control"
                v-model="form.account_no"
                placeholder="Cth : Account No"
              />
            </div>
          </div>
          <hr />
          <button class="btn btn-primary me-3">
            <span class="fa fa-save me-1"></span> Simpan
          </button>
          <button class="btn btn-secondary">
            <span class="fa fa-save me-1"></span> Reset
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import LayoutApp from "@/Layouts/BackofficeLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  layout: LayoutApp,
  props: {
    company: Object,
    errors: Object,
    data: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      name: props.data.name,
      bank: props.data.bank,
      account_no: props.data.account_no,
    });
    return { form };
  },
  methods: {
    submit() {
      if (this.data.page == "create") {
        this.form.post(`/payment-method`);
      } else {
        this.form.put(`/payment-method/` + this.form.id);
      }
    },
  },
};
</script>
