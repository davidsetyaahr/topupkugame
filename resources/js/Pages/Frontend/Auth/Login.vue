<template>
  <form @submit.prevent="submit">
    <section style="background: #100c23">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body p-5">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">
                    Please enter your email and password!
                    <!-- {{ session.error }} -->
                  </p>
                  <!-- <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                    v-if="session('error')"
                  >
                    {{ session("message") }}
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="alert"
                      aria-label="Close"
                    ></button>
                  </div> -->

                  <div class="form-outline form-white mb-4">
                    <label class="fw-bold mb-2" for=""
                      >Email
                      <span v-if="errors.email" style="color: red"
                        >* {{ errors.email }}</span
                      ></label
                    >
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.email"
                      placeholder="Cth : Email"
                    />
                  </div>

                  <div class="form-outline form-white mb-4">
                    <label class="fw-bold mb-2" for=""
                      >Password
                      <span v-if="errors.password" style="color: red"
                        >* {{ errors.password }}</span
                      ></label
                    >
                    <input
                      type="password"
                      class="form-control"
                      v-model="form.password"
                      placeholder="Cth : Password"
                    />
                  </div>

                  <button
                    class="btn btn-primary btn-lg px-5"
                    type="submit"
                  >
                    Login
                  </button>
                </div>

                <div>
                  <p class="mb-0">
                    Don't have an account?
                    <Link
                      href="/auth-customer/register"
                      class="color-orange fw-bold"
                      >Sign Up</Link
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
      email: props.data.email,
      password: props.data.password,
    });
    return { form };
  },
  methods: {
    submit() {
      this.form.post(`/auth-customer/store-login`);
    },
  },
};
</script>
