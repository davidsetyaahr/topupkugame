<template>
  <!-- <div class="row">
        <div class="col">
            <a href="/sell/create" class="btn btn-primary btn-rounded px-3"><span class="fa fa-plus"></span> Tambah Pemesanan</a>
        </div>
    </div> -->
  <div class="row">
    <div class="col-md-12">
      <div className="table-responsive">
        <table className="table table-custom">
          <thead>
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>ID Game</th>
              <th>ID Server ID</th>
              <th>Voucher</th>
              <th>Pembayaran</th>
              <th>Total</th>
              <th width="25%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, key) in sell" :key="key">
              <td>{{ key + 1 }}</td>
              <td>
                {{ data.customer.name }}
                <br>
                {{ data.customer.phone }}
                </td>
              <td>{{ data.username_game }}</td>
              <td>{{ data.server_id }}</td>
              <td>
                {{ data.voucher.product.name }} <br />
                {{ data.voucher.title }}
              </td>
              <td>BCA</td>
              <td>
                <span class="color-orange">
                  {{ formatRupiah(data.amount) }}</span
                >
              </td>
              <td>
                <a
                  href="#"
                  @click="setModal(key)"
                  data-bs-toggle="modal"
                  data-bs-target="#modalCek"
                  class="btn btn-primary btn-sm me-2"
                  >Cek Bukti Transfer</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div
    class="modal fade"
    id="modalCek"
    tabindex="-1"
    aria-labelledby="modalCekLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content" v-if="typeof modal.id != 'undefined'">
        <div
          class="modal-header"
          style="background: #19181a; color: #30293d; border-bottom: #fd9800"
        >
          <h5 class="" id="modalDetailReservasiLabel" style="color: #fd9800">
            Bukti Transfer
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
          <div class="row">
            <div class="col-md-12 mb-3" style="text-align: center">
              <img
                style="width: 300px"
                :src="`/storage/proof-of-payment/${modalDetail.proof_of_payment}`"
                alt=""
              />
            </div>
            <div class="col-md-12 mb-3">
              <hr />
              <a
                href="#"
                class="btn btn-success me-3"
                @click="this.acc(modalDetail.id, modalDetail.username_game)"
                ><span class="fa fa-save me-1"></span> Acc</a
              >

              <a
                class="btn btn-danger me-3"
                @click="this.reject(modalDetail.id, modalDetail.username_game)"
                ><span class="fa fa-exclamation-triangle me-1"></span> Tolak</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
</template>
<script>
import LayoutApp from "@/Layouts/BackofficeLayout.vue";
import Search from "@/Components/Search.vue";
import { formatRupiah, asset } from "@/Utils/MyFunction.js";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/vue3";

export default {
  layout: LayoutApp,
  props: {
    sell: Object,
    url: String,
    ziggy: Object,
  },
  components: {
    Search,
  },
  data() {
    return {
      modal: {},
      modalDetail: {},
    };
  },
  setup(props) {
    const form = useForm({});
    return { form };
  },
  methods: {
    formatRupiah,
    asset,
    acc(id, name) {
      if (confirm("Yakin ingin mengacc id game " + name + " ?")) {
        this.form.get("/pemesanan/acc/" + id);
        const truck_modal = document.querySelector("#modalCek");
        const modal = bootstrap.Modal.getInstance(truck_modal);
        modal.hide();
      }
    },
    reject(id, name) {
      if (confirm("Yakin ingin menolak id game " + name + " ?")) {
        this.form.get("/pemesanan/reject/" + id);
        const truck_modal = document.querySelector("#modalCek");
        const modal = bootstrap.Modal.getInstance(truck_modal);
        modal.hide();
      }
    },
    setModal(key) {
      this.modal = this.sell[key];
    },
  },
  watch: {
    modal: function (val) {
      axios.get(this.ziggy.url + "/pemesanan/show/" + val.id).then((response) => {
        this.modalDetail = response.data;
      });
    },
  },
};
</script>
