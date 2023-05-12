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
              <input
                type="file"
                class="form-control"
                @input="form.banner = $event.target.files[0]"
              />
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
              <input
                type="file"
                class="form-control"
                @input="form.top_banner = $event.target.files[0]"
              />
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
          <div class="col">
            <a
              href="#"
              data-bs-toggle="modal"
              data-bs-target="#modalAddVoucher"
              class="btn btn-info btn-sm"
            >
              <span class="fa fa-plus"></span> Add New
            </a>
          </div>
          <div class="col-md-12">
            <div className="table-responsive">
              <table className="table table-custom">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Voucher</th>
                    <th>Harga</th>
                    <th>Margin</th>
                    <th width="25%">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(v, k) in voucher" :key="k">
                    <td>{{ k + 1 }}</td>
                    <td>{{ v.title }}</td>
                    <td>{{ v.amount }}</td>
                    <td>{{ v.margin }}</td>
                    <td>
                      <a
                        @click="setModal(v.id)"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEditVoucher"
                        class="btn btn-sm btn-info"
                        style="margin-right: 15px"
                        >Edit</a
                      >
                      <a
                        href="javascript:;"
                        class="btn btn-sm btn-danger"
                        @click="this.delete(v.id, v.title)"
                        >Hapus</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
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

  <!-- Modal -->
  <div
    class="modal fade"
    id="modalAddVoucher"
    tabindex="-1"
    aria-labelledby="modalAddVoucherLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- //   <div class="modal-content" v-if="typeof modal.id != 'undefined'"> -->
        <div
          class="modal-header"
          style="background: #19181a; color: #30293d; border-bottom: #fd9800"
        >
          <h5 class="" id="modalDetailReservasiLabel" style="color: #fd9800">
            Add New Voucher
          </h5>
          <button
            type="button"
            class=""
            style="
              background: #4826f6;
              border-color: #4826f6;
              border-radius: 2px;
            "
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            X
          </button>
        </div>
        <div class="modal-body" style="background: #19181a; color: #30293d">
          <form @submit.prevent="submitVoucher">
            <div class="row">
              <div class="col-md-12 mb-3" style="text-align: center">
                <div class="row align-items-end">
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Voucher
                      <span v-if="errors.voucher" style="color: red"
                        >* {{ errors.voucher }}</span
                      ></label
                    >
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Cth : 112 Diamonds"
                      v-model="formVoucher.voucher"
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Harga
                      <span v-if="errors.amount" style="color: red"
                        >* {{ errors.amount }}</span
                      ></label
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Cth: 30000"
                      v-model="formVoucher.amount"
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Keuntungan
                      <span v-if="errors.margin" style="color: red"
                        >* {{ errors.margin }}</span
                      ></label
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Cth: 5000"
                      v-model="formVoucher.margin"
                    />
                  </div>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <hr />
                <button class="btn btn-primary me-3">
                  <span class="fa fa-save me-1"></span> Simpan
                </button>
                <a
                  href="#"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <span class="fa fa-save me-1"></span> Cancel
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Modal -->
  <div
    class="modal fade"
    id="modalEditVoucher"
    tabindex="-1"
    aria-labelledby="modalEditVoucherLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- //   <div class="modal-content" v-if="typeof modal.id != 'undefined'"> -->
        <div
          class="modal-header"
          style="background: #19181a; color: #30293d; border-bottom: #fd9800"
        >
          <h5 class="" id="modalDetailReservasiLabel" style="color: #fd9800">
            Edit Voucher
          </h5>
          <button
            type="button"
            class=""
            style="
              background: #4826f6;
              border-color: #4826f6;
              border-radius: 2px;
            "
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            X
          </button>
        </div>
        <div class="modal-body" style="background: #19181a; color: #30293d">
          <form @submit.prevent="updatedVoucher">
            <div class="row">
              <div class="col-md-12 mb-3" style="text-align: center">
                <div class="row align-items-end">
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Voucher
                      <span v-if="errors.voucher" style="color: red"
                        >* {{ errors.voucher }}</span
                      ></label
                    >
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Cth : 112 Diamonds"
                      v-model="formEditVoucher.voucher"
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Harga
                      <span v-if="errors.amount" style="color: red"
                        >* {{ errors.amount }}</span
                      ></label
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Cth: 30000"
                      v-model="formEditVoucher.amount"
                    />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for=""
                      >Keuntungan
                      <span v-if="errors.margin" style="color: red"
                        >* {{ errors.margin }}</span
                      ></label
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Cth: 5000"
                      v-model="formEditVoucher.margin"
                    />
                  </div>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <hr />
                <button class="btn btn-primary me-3">
                  <span class="fa fa-save me-1"></span> Simpan
                </button>
                <a
                  href="#"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <span class="fa fa-save me-1"></span> Cancel
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
</template>
<script>
import LayoutApp from "@/Layouts/BackofficeLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
  layout: LayoutApp,
  props: {
    company: Array,
    errors: Object,
    data: Object,
    voucher: Object,
    url: String,
    ziggy: Object,
  },
  data() {
    return {
      modal: {},
      modalDetail: {},
    };
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      name: props.data.name,
      company_id: props.data.company_id,
      banner: props.data.banner,
      top_banner: props.data.top_banner,
      desc: props.data.desc,
    });
    const formVoucher = useForm({
      product_id: props.data.id,
      voucher: props.data.voucher,
      amount: props.data.amount,
      margin: props.data.margin,
    });
    const formEditVoucher = useForm({
      id: "",
      product_id: "",
      voucher: "",
      amount: "",
      margin: "",
    });
    return { form, formVoucher, formEditVoucher };
  },
  mounted() {
    console.log(this.errors);
  },
  methods: {
    submit() {
      //   if (this.$refs.banner) {
      //     this.form.banner = this.$refs.banner.files[0];
      //   }
      //   if (this.$refs.top_banner) {
      //     this.form.top_banner = this.$refs.top_banner.files[0];
      //   }
      if (this.data.page == "create") {
        this.form.post(`/produk`);
      } else {
        // this.form.put(`/produk/` + this.form.id);
        Inertia.post(`/produk/${this.form.id}`, {
          _method: "put",
          id: this.form.id,
          name: this.form.name,
          company_id: this.form.company_id,
          banner: this.form.banner,
          top_banner: this.form.top_banner,
          desc: this.form.desc,
        });
      }
    },
    delete(id, name) {
      if (confirm("Yakin ingin menghapus voucher " + name + "?")) {
        Inertia.get("/voucher/delete/" + id);
      }
    },
    submitVoucher() {
      if (confirm("Yakin ingin menambah voucher ?")) {
        this.formVoucher.post(`/voucher/store`);
      }
    },
    setModal(key) {
      this.modal = key;
    },
    submitVoucher() {
      if (confirm("Yakin ingin menambah voucher ?")) {
        this.formVoucher.post(`/voucher/store`);
      }
    },
    updatedVoucher() {
      if (confirm("Yakin ingin mengupdate voucher ?")) {
        this.formEditVoucher.post(`/voucher/update`);
      }
    },
  },
  watch: {
    modal: function (val) {
      axios.get(this.ziggy.url + "/voucher/" + val).then((response) => {
        this.formEditVoucher.id = response.data.id;
        this.formEditVoucher.product_id = response.data.product_id;
        this.formEditVoucher.voucher = response.data.title;
        this.formEditVoucher.amount = response.data.amount;
        this.formEditVoucher.margin = response.data.margin;
      });
    },
  },
};
</script>
