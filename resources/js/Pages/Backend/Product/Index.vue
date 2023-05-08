<template>
  <div class="row">
    <div class="col">
      <Link href="/produk/create" class="btn btn-primary btn-rounded px-3"
        ><span class="fa fa-plus"></span> Tambah Product</Link
      >
    </div>
    <div class="col-md-3">
      <Search />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div className="table-responsive">
        <table className="table table-custom">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Product</th>
              <th>Company</th>
              <th>Jumlah Voucher</th>
              <th width="25%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, key) in product" :key="key">
              <td>{{ key + 1 }}</td>
              <td>{{ data.name }}</td>
              <td>{{ data.company.name }}</td>
              <td>{{ data.voucher.length }}</td>
              <td>
                <a
                  :href="`produk/${data.id}/edit`"
                  class="btn btn-sm btn-info"
                  style="margin-right: 15px"
                  >Edit</a
                >
                <a
                  href="javascript:;"
                  class="btn btn-sm btn-danger"
                  @click="this.delete(data.id, data.name)"
                  >Hapus</a
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
import { Inertia } from "@inertiajs/inertia";
export default {
  layout: LayoutApp,
  props: {
    product: Object,
  },
  components: {
    Search,
  },
  methods: {
    delete(id, name) {
      if (confirm("Yakin ingin menghapus produk " + name + " ?")) {
        Inertia.delete("/produk/" + id);
      }
    },
  },
};
</script>
