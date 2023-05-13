<script setup>
import { Head } from "@inertiajs/vue3";
</script>
<template>
  <Head :title="title" />
  <div class="sidebar" @click.stop="openSidebar = true" :class="{hide : !openSidebar}">
    <div class="logo text-center fw-bold">
      <span class="fa fa-gamepad me-2"></span> TopUpKu Game
    </div>
    <ul>
      <li :class="segment1 == 'dashboard' ? 'active' : ''">
        <Link href="/dashboard"
          ><span class="fa fa-dashboard"></span> Dashboard
        </Link>
      </li>
      <li :class="segment1 == 'pemesanan' && segment2 == null ? 'active' : ''">
        <Link href="/pemesanan"
          ><span class="fa fa-mobile-alt"></span> Pemesanan</Link
        >
      </li>
      <li :class="segment1 == 'produk' ? 'active' : ''">
        <Link href="/produk"><span class="fa fa-gamepad"></span> Produk</Link>
      </li>
      <li :class="segment1 == 'customer' ? 'active' : ''">
        <Link href="/customer"><span class="fa fa-users"></span> Customer</Link>
      </li>
      <li :class="segment1 == 'banner' ? 'active' : ''">
        <Link href="/banner"><span class="fa fa-image"></span> Banner</Link>
      </li>
      <li :class="segment1 == 'payment-method' ? 'active' : ''">
        <Link href="/payment-method"
          ><span class="fa fa-credit-card"></span> Payment Method</Link
        >
      </li>
      <li :class="segment2 == 'rekap' ? 'active' : ''">
        <Link href="/pemesanan/rekap"
          ><span class="fa fa-file"></span> Rekap</Link
        >
      </li>
      <li :class="segment1 == 'setting' ? 'active' : ''">
        <Link href="/setting/create"
          ><span class="fa fa-gear"></span> Setting Company</Link
        >
      </li>
    </ul>
    <img
      src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/22ba8af1-9afe-4a42-8798-aa2a150683e0/dcc3x19-0caebc89-cddd-49e1-a23a-6cfe40e26bbe.png/v1/fill/w_1024,h_575,strp/mobile_legends_gatot_kaca_transparent__ahrat_king_by_b_la_ze_dcc3x19-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NTc1IiwicGF0aCI6IlwvZlwvMjJiYThhZjEtOWFmZS00YTQyLTg3OTgtYWEyYTE1MDY4M2UwXC9kY2MzeDE5LTBjYWViYzg5LWNkZGQtNDllMS1hMjNhLTZjZmU0MGUyNmJiZS5wbmciLCJ3aWR0aCI6Ijw9MTAyNCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.xRBLY3WcKPH6t0JrNZWB1AxzGyfTnIYgJv78MERZRcc"
      alt=""
      class="sticky-img"
    />
  </div>
  <div class="main"  :class="{full : !openSidebar, sticky : isMobile}">
    <div class="header justify-content-between">
      <a href="" class="color-orange"  @click.stop.prevent="openSidebar = !openSidebar"><span class="fa fa-bars"></span></a>
      <div class="d-flex align-items-lg-center">
        <span class="user me-3">
          <span class="fa fa-user"></span>
        </span>
        <div>
          <div class="dropdown">
            <button
              class="btn btn-secondary dropdown-toggle"
              type="button"
              id="dropdownMenuButton1"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <span class="me-3 color-white">Admin</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><Link class="dropdown-item" :href="route('logout')" method="post" as="button">Logout</Link></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <slot />
    </div>
  </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    title: String,
    ziggy: Object,
  },
  data() {
    return {
      openSidebar : true,
      isMobile : false,
      segment1: window.location.pathname.split("/")[1],
      segment2: window.location.pathname.split("/")[2],
    };
  },
  methods:{
    checkMobile(x) {
      if (x.matches) {
        // If media query matches
        this.isMobile = true;
        this.openSidebar = false;
      }
    },
  },
  mounted(){
    if(this.isMobile){
      document.querySelector('body,html').addEventListener('click',()=>{
        this.openSidebar = false
      })
    }
    var x = window.matchMedia("(max-width: 768px)");
    this.checkMobile(x); // Call listener function at run time
  },
  watch: {
    title() {
      if(this.isMobile){
        this.openSidebar = false
      }
      this.segment1 = window.location.pathname.split("/")[1];
      this.segment2 = window.location.pathname.split("/")[2];
    },
  },
};
</script>
<style lang="scss">
@import "@/../css/_variable.scss";
@import "@/../css/backoffice.scss";
</style>
