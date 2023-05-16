<template>
  <div class="row">
    <div class="col">
      <Link
        href="/payment-method/create"
        class="btn btn-primary btn-rounded px-3"
        ><span class="fa fa-plus"></span> Tambah Payment Method</Link
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
              <th>Bank</th>
              <th>Nama</th>
              <th>Account No</th>
              <th>Image</th>
              <th width="25%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, key) in data" :key="key">
              <td>{{ key + 1 }}</td>
              <td>{{ data.bank }}</td>
              <td>{{ data.name }}</td>
              <td>{{ data.number }}</td>
              <td>
                <img
                  style="width: 300px"
                  :src="`/storage/payment-method/${data.img}`"
                  alt=""
                />
              </td>
              <td>
                <a
                  :href="`payment-method/${data.id}/edit`"
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
    data: Object,
  },
  components: {
    Search,
  },
  methods: {
    delete(id, name) {
      if (confirm("Yakin ingin menghapus payment method " + name + " ?")) {
        Inertia.delete("/payment-method/" + id);
      }
    },
  },
};
</script>
