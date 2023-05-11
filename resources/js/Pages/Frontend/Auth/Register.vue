<template>
  <form @submit.prevent="submit">
    <section style="background: #100c23">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body p-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                  <p class="text-white-50 mb-5">
                    Please fill this form before you buy!
                  </p>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.name"
                      placeholder="Cth : Nama"
                    />
                    <label for=""
                      >Nama
                      <span v-if="errors.name" style="color: red"
                        >* {{ errors.name }}</span
                      ></label
                    >
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="text"
                      class="form-control error"
                      v-model="form.email"
                      placeholder="Cth : Email"
                    />
                    <label for=""
                      >Email
                      <span v-if="errors.email" style="color: red"
                        >* {{ errors.email }}</span
                      ></label
                    >
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="number"
                      class="form-control"
                      v-model="form.phone"
                      placeholder="Cth : Telepon"
                    />
                    <label for=""
                      >Telepon
                      <span v-if="errors.phone" style="color: red"
                        >* {{ errors.phone }}</span
                      ></label
                    >
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input
                      type="password"
                      class="form-control"
                      v-model="form.password"
                      placeholder="Cth : Password"
                    />
                    <label for=""
                      >Password
                      <span v-if="errors.password" style="color: red"
                        >* {{ errors.password }}</span
                      ></label
                    >
                  </div>

                  <button
                    class="btn btn-outline-light btn-lg px-5"
                    type="submit"
                  >
                    Sign Up
                  </button>
                </div>

                <div>
                  <p class="mb-0">
                    Have an account?
                    <a href="/auth-customer/login" class="text-white-50 fw-bold"
                      >Login</a
                    >
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</template>

<style>
@import "@/../css/frontend.scss";
</style>
<script>
import { useForm } from "@inertiajs/vue3";
export default {
  props: {
    errors: Object,
    data: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.data.id,
      name: props.data.name,
      phone: props.data.phone,
      email: props.data.email,
      password: props.data.password,
    });
    return { form };
  },
  methods: {
    submit() {
      this.form.post(`/auth-customer/store-register`);
    },
  },
};
</script>
