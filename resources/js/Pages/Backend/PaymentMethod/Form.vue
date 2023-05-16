<template>
  <div class="row">
    <div class="col">
      <div class="card p-3">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for=""
                >Bank
                <span v-if="errors.bank" style="color: red"
                  >* {{ errors.bank }}</span
                ></label
              >
              <input
                type="text"
                class="form-control"
                v-model="form.bank"
                placeholder="Cth : Bank"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for=""
                >Nama
                <span v-if="errors.name" style="color: red"
                  >* {{ errors.name }}</span
                ></label
              >
              <input
                type="text"
                class="form-control"
                v-model="form.name"
                placeholder="Cth : Nama"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for=""
                >Account No
                <span v-if="errors.account_no" style="color: red"
                  >* {{ errors.account_no }}</span
                ></label
              >
              <input
                type="number"
                class="form-control"
                v-model="form.account_no"
                placeholder="Cth : Account No"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for=""
                >Image
                <span
                  v-if="this.data.page == 'edit'"
                  style="font-size: 10px"
                  class="text-danger"
                  >(Jika tidak ingin diubah biarkan saja)</span
                ><span v-if="errors.img" style="color: red"
                  >* {{ errors.img }}</span
                ></label
              >
              <input type="file" class="form-control" ref="img" />
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
import { Inertia } from "@inertiajs/inertia";

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
      bank: props.data.bank,
      img: null,
      name: props.data.name,
      account_no: props.data.account_no,
    });
    return { form };
  },
  methods: {
    submit() {
      if (this.$refs.img) {
        this.form.img = this.$refs.img.files[0];
      }
      if (this.data.page == "create") {
        this.form.post(`/payment-method`);
      } else {
        // this.form.put(`/payment-method/` + this.form.id);
        Inertia.post(`/payment-method/${this.form.id}`, {
          _method: "put",
          id: this.form.id,
          img: this.form.img,
          name: this.form.name,
          account_no: this.form.account_no,
          bank: this.form.bank,
        });
      }
    },
  },
};
</script>
