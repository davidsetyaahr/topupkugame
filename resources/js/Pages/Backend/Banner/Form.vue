<template>
  <div class="row">
    <div class="col">
      <div class="card p-3">
        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for=""
                >Banner
                <span
                  v-if="this.data.page == 'edit'"
                  style="font-size: 10px"
                  class="text-danger"
                  >(Jika tidak ingin diubah biarkan saja)</span
                ><span v-if="errors.image_banner" style="color: red"
                  >* {{ errors.image_banner }}</span
                ></label
              >
              <input type="file" class="form-control" ref="image_banner" />
            </div>
            <div class="col-md-6 mb-3">
              <label for=""
                >URL
                <span v-if="errors.url" style="color: red"
                  >* {{ errors.url }}</span
                ></label
              >
              <input
                type="text"
                class="form-control"
                v-model="form.url"
                placeholder="Cth : Promo mobile legend"
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
import { useForm } from "@inertiajs/vue3";

export default {
  layout: LayoutApp,
  props: {
    company: Object,
    errors: Object,
    data: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      image_banner: props.data.image_banner,
      url: props.data.url,
    });
    return { form };
  },
  methods: {
    submit() {
      if (this.$refs.image_banner) {
        this.form.image_banner = this.$refs.image_banner.files[0];
      }
      if (this.data.page == "create") {
        this.form.post(`/banner`);
      } else {
        this.form.put(`/banner/` + this.form.id);
      }
    },
  },
};
</script>
