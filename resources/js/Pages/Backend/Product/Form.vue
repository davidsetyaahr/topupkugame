<template>
  <div class="row">
    <div class="col">
      <div class="card p-3">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for=""
                >Nama Produk
                <span v-if="errors.name" style="color: red"
                  >* {{ errors.name }}</span
                ></label
              >
              <input
                type="text"
                v-model="form.name"
                class="form-control"
                placeholder="Masukkan nama produk disini..."
              />
            </div>
            <div class="col-md-4 mb-3">
              <label for=""
                >Company
                <span v-if="errors.company_id" style="color: red"
                  >* {{ errors.company_id }}</span
                ></label
              >
              <select
                name=""
                id=""
                class="form-control"
                v-model="form.company_id"
              >
                <option value="">Pilih Company</option>
                <!-- <option
                  v-for="(data, key) in companies"
                  :key="{ key }"
                  :value="{ key }"
                >
                  {{ data }}
                </option> -->
                <option v-for="(key, index) in company" :value="key.id">
                  {{ key.name }}
                </option>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for=""
                >Banner
                <span
                  v-if="this.data.page == 'edit'"
                  style="font-size: 10px"
                  class="text-danger"
                  >(Jika tidak ingin diubah biarkan saja)</span
                ><span v-if="errors.banner" style="color: red"
                  >* {{ errors.banner }}</span
                ></label
              >
              <input type="file" class="form-control" ref="banner" />
            </div>
            <div class="col-md-4 mb-3">
              <label for=""
                >Top Banner
                <span
                  v-if="this.data.page == 'edit'"
                  style="font-size: 10px"
                  class="text-danger"
                  >(Jika tidak ingin diubah biarkan saja)</span
                ><span v-if="errors.top_banner" style="color: red"
                  >* {{ errors.top_banner }}</span
                ></label
              >
              <input type="file" class="form-control" ref="top_banner" />
            </div>
            <div class="col-md-12 mb-3">
              <label for=""
                >Deskripsi
                <span v-if="errors.desc" style="color: red"
                  >* {{ errors.desc }}</span
                ></label
              >
              <textarea
                v-model="form.desc"
                class="form-control"
                placeholder="Masukkan deskripsi"
                name=""
                rows="3"
              ></textarea>
            </div>
          </div>
          <hr />
          <div
            v-for="(data, key) in form.voucher"
            :key="key"
            class="row align-items-end"
          >
            <div class="col-md-4 mb-3">
              <label for=""
                >Voucher
                <span v-if="errors[`voucher.${key}`]" style="color: red"
                  >* {{ errors[`voucher.${key}`] }}</span
                ></label
              >
              <input
                type="text"
                class="form-control"
                v-model="form.voucher[key]"
                placeholder="Cth : 112 Diamonds"
              />
            </div>
            <div class="col-md-4 mb-3">
              <label for=""
                >Harga
                <span v-if="errors[`amount.${key}`]" style="color: red"
                  >* {{ errors[`amount.${key}`] }}</span
                ></label
              >
              <input
                type="number"
                class="form-control"
                placeholder="Cth: 30000"
                v-model="form.amount[key]"
              />
            </div>
            <div class="col-md-3 mb-3">
              <label for=""
                >Keuntungan
                <span v-if="errors[`margin.${key}`]" style="color: red"
                  >* {{ errors[`margin.${key}`] }}</span
                ></label
              >
              <input
                type="number"
                class="form-control"
                placeholder="Cth: 5000"
                v-model="form.margin[key]"
              />
            </div>
            <div class="col-md-1 mb-3">
              <button
                @click="removeField(key)"
                type="button"
                class="btn btn-danger"
              >
                <span class="fa fa-trash"></span>
              </button>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <button
                @click="addNew()"
                type="button"
                class="btn btn-info btn-sm"
              >
                <span class="fa fa-plus"></span> Add New
              </button>
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
import { useForm } from "@inertiajs/vue3";

export default {
  layout: LayoutApp,
  props: {
    company: Array,
    errors: Object,
    data: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      name: props.data.name,
      company_id: props.data.company_id,
      banner: props.data.banner,
      top_banner: props.data.top_banner,
      desc: props.data.desc,
      voucher: props.data.voucher,
      amount: props.data.amount,
      margin: props.data.margin,
      oldidvoucher: props.data.oldidvoucher,
      oldvoucher: props.data.oldvoucher,
      oldamount: props.data.oldamount,
      oldmargin: props.data.oldmargin,
    });
    return { form };
  },
  //   computed: {
  //     companies() {
  //       let arr = [];
  //       this.company.map(function (data, key) {
  //         arr[key] = data.name;
  //       });

  //       return arr;
  //     },
  //   },
  mounted() {
    console.log(this.errors);
  },
  methods: {
    submit() {
      if (this.$refs.banner) {
        this.form.banner = this.$refs.banner.files[0];
      }
      if (this.$refs.top_banner) {
        this.form.top_banner = this.$refs.top_banner.files[0];
      }
      if (this.data.page == "create") {
        this.form.post(`/produk`);
      } else {
        this.form.put(`/produk/` + this.form.id);
      }
    },
    addNew() {
      const lengthArr = this.form.voucher.length;
      this.form.voucher[lengthArr] = "";
      this.form.amount[lengthArr] = "";
      this.form.margin[lengthArr] = "";
    },
    removeField(key) {
      this.form.voucher.splice(key, 1);
      this.form.amount.splice(key, 1);
      this.form.margin.splice(key, 1);
    },
  },
};
</script>
