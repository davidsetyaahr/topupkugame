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
                <a href="" class="btn btn-primary btn-sm me-2"
                  >Cek Bukti Transfer</a
                >
                <a
                  href="#"
                  class="btn btn-success btn-sm"
                  @click="this.acc(data.id, data.username_game)"
                  >Acc</a
                >
                <br />
                <a
                  class="btn btn-danger btn-sm"
                  style="margin-top: 6px"
                  @click="this.reject(data.id, data.username_game)"
                  >Tolak</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import LayoutApp from "@/Layouts/BackofficeLayout.vue";
import Search from "@/Components/Search.vue";
import { formatRupiah, asset } from "@/Utils/MyFunction.js";
import { Inertia } from "@inertiajs/inertia";

export default {
  layout: LayoutApp,
  props: {
    sell: Object,
  },
  components: {
    Search,
  },
  methods: {
    formatRupiah,
    asset,
    acc(id, name) {
      if (confirm("Yakin ingin mengacc id game " + name + " ?")) {
        Inertia.get("/pemesanan/acc/" + id);
      }
    },
    reject(id, name) {
      if (confirm("Yakin ingin menolak id game " + name + " ?")) {
        Inertia.get("/pemesanan/reject/" + id);
      }
    },
  },
};
</script>
