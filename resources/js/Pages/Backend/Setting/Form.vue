<template>
  <div class="row">
    <div class="col">
      <div class="card p-3">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="">Facebook</label>
              <input
                type="text"
                class="form-control"
                v-model="form.facebook"
                placeholder="Cth : Facebook"
              />
            </div>
            <div class="col-md-3 mb-3">
              <label for="">Instagram</label>
              <input
                type="text"
                class="form-control"
                v-model="form.instagram"
                placeholder="Cth : Instagram"
              />
            </div>
            <div class="col-md-3 mb-3">
              <label for="">Twitter</label>
              <input
                type="text"
                class="form-control"
                v-model="form.twitter"
                placeholder="Cth : Twitter"
              />
            </div>
            <div class="col-md-3 mb-3">
              <label for="">Youtube</label>
              <input
                type="text"
                class="form-control"
                v-model="form.youtube"
                placeholder="Cth : Youtube"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for="">Whatsapp</label>
              <input
                type="number"
                class="form-control"
                v-model="form.whatsapp"
                placeholder="Cth : Whatsapp"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for="">Tiktok</label>
              <input
                type="text"
                class="form-control"
                v-model="form.tiktok"
                placeholder="Cth : Tiktok"
              />
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

export default {
  layout: LayoutApp,
  props: {
    errors: Object,
    data: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      facebook: props.data.facebook,
      instagram: props.data.instagram,
      twitter: props.data.twitter,
      youtube: props.data.youtube,
      whatsapp: props.data.whatsapp,
      tiktok: props.data.tiktok,
    });
    return { form };
  },
  methods: {
    submit() {
      if (this.data.page == "create") {
        this.form.post(`/setting`);
      } else {
        this.form.put(`/setting/` + this.form.id);
      }
    },
  },
};
</script>
