<template>
  <!-- <div class="row">
    <div class="col">
      <Link href="/banner/create" class="btn btn-primary btn-rounded px-3"
        ><span class="fa fa-plus"></span> Tambah Banner</Link
      >
    </div>
    <div class="col-md-3">
      <Search />
    </div>
  </div> -->
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
                <a
                  :href="`payment-method/${data.id}/edit`"
                  class="btn btn-sm btn-info"
                  style="margin-right: 15px"
                  >Edit</a
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
      if (confirm("Yakin ingin menghapus banner ?")) {
        Inertia.delete("/banner/" + id);
      }
    },
  },
};
</script>
