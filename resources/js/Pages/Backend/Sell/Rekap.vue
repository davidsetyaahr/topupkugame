<template>
  <!-- <div class="row">
        <div class="col">
            <a href="/sell/create" class="btn btn-primary btn-rounded px-3"><span class="fa fa-plus"></span> Tambah Pemesanan</a>
        </div>
    </div> -->
  <div class="row">
    <div class="col-md-12">
      <form @submit.prevent="submit" id="form-vue">
        <div class="row">
          <div class="col-md-4 mb-3">
            <input
              type="date"
              name="dari"
              class="form-control py-2"
              placeholder="Dari tanggal"
              v-model="form.dari"
            />
          </div>
          <div class="col-md-4 mb-3">
            <input
              type="date"
              name="sampai"
              class="form-control py-2"
              placeholder="Sampai tanggal"
              v-model="form.sampai"
            />
          </div>
          <div class="col-md-2 mb-3">
            <button class="btn btn-primary" type="submit" id="button-addon2">
              <span class="fa fa-search"></span> Filter
            </button>
          </div>
        </div>
      </form>
      <div className="table-responsive">
        <table className="table table-custom">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode</th>
              <th>No Hp</th>
              <th>ID Game</th>
              <th>ID Server ID</th>
              <th>Voucher</th>
              <th>Pembayaran</th>
              <th>Total</th>
              <th>Margin</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, key) in data" :key="key">
              <td>{{ key + 1 }}</td>
              <td>{{ data.code }}</td>
              <td>{{ data.phone }}</td>
              <td>{{ data.username_game }}</td>
              <td>{{ data.server_id != null ? data.server_id : "-" }}</td>
              <td>
                {{
                  data.voucher.product != null ? data.voucher.product.name : "-"
                }}
                <br />
                {{ data.voucher.title }}
              </td>
              <td>{{ data.payment_method }}</td>
              <td>
                <span class="color-orange">
                  {{ formatRupiah(data.amount) }}</span
                >
              </td>
              <td>
                <span class="color-orange">
                  {{ formatRupiah(data.margin) }}</span
                >
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"></td>
              <td>{{ formatRupiah(this.total) }}</td>
              <td>{{ formatRupiah(this.margin) }}</td>
            </tr>
          </tfoot>
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
  data() {
    return {
      form: {
        dari: this.filter.dari,
        sampai: this.filter.sampai,
      },
    };
  },
  props: {
    data: Object,
    filter: Array,
    total: Number,
    margin: Number,
  },
  components: {
    Search,
  },
  methods: {
    formatRupiah,
    asset,
    submit() {
      Inertia.get("", this.form);
    },
  },
};
</script>
