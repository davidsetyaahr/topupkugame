<template>
  <div class="row justify-content-end">
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
              <th>Nama</th>
              <th>Nomor Telepon</th>
              <th width="25%">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data, key) in data" :key="key">
              <td>{{ key + 1 }}</td>
              <td>{{ data.name }}</td>
              <td>{{ data.phone }}</td>
              <td>
                <!-- <a
                  :href="`customer/${data.id}/edit`"
                  class="btn btn-sm btn-info"
                  style="margin-right: 15px"
                  >Edit</a
                >
                <a
                  href="javascript:;"
                  class="btn btn-sm btn-danger"
                  @click="this.delete(data.id, data.name)"
                  >Hapus</a
                > -->
                <a
                  @click="setModal(key)"
                  data-bs-toggle="modal"
                  data-bs-target="#modalReset"
                  class="btn btn-success btn-sm px-3"
                  >Reset Password</a
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
    id="modalReset"
    tabindex="-1"
    aria-labelledby="modalResetLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content" v-if="typeof modal.id != 'undefined'">
        <div
          class="modal-header"
          style="background: #19181a; color: #30293d; border-bottom: #fd9800"
        >
          <h5 class="" id="modalDetailReservasiLabel" style="color: #fd9800">
            Reset Password {{ modalDetail.name }}
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
          <form @submit.prevent="submit">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="">Password</label>
                <input
                  type="text"
                  v-model="form.reset"
                  class="form-control"
                  placeholder="Masukkan password disini..."
                />
                <hr />
                <button class="btn btn-primary me-3">
                  <span class="fa fa-save me-1"></span> Simpan
                </button>
                <button class="btn btn-secondary" type="reset">
                  <span class="fa fa-refresh me-1"></span> Batal
                </button>
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
import Search from "@/Components/Search.vue";
import { Inertia } from "@inertiajs/inertia";
export default {
  layout: LayoutApp,
  props: {
    data: Object,
    url: String,
    ziggy: Object,
  },
  data() {
    return {
      modal: {},
      modalDetail: {},
      form: {
        id: "",
        reset: "",
        name: "",
      },
    };
  },
  components: {
    Search,
  },
  methods: {
    submit() {
      let data = this.form;
      if (confirm("Yakin ingin mereset password " + data.name + " ?")) {
        Inertia.post("/customer", data);
      }
    },
    setModal(key) {
      this.modal = this.data[key];
    },
  },
  watch: {
    modal: function (val) {
      axios.get(this.ziggy.url + "/customer/" + val.id).then((response) => {
        this.modalDetail = response.data;
        this.form.reset = Math.random().toString(36).slice(2);
        this.form.id = val.id;
        this.form.name = val.name;
      });
    },
  },
};
</script>
