<template>
    <div class="sticky-sidebar" v-if="openSidebar" @click.prevent="openSidebar = !openSidebar">
        <div class="sidebar" @click.stop="openSidebar=true">
            <Link href="/" class="sidebar-header mt-4 color-white text-decoration-none">
                <h5>
                    <span class="fas fa-gamepad me-1 color-orange"></span> TopUpkuGame
                </h5>
            </Link>
            <hr style="border-color:white;opacity:.4">
            <Link href="/" class="sidebar-link"><span class="fa fa-home me-2 color-orange"></span> Beranda</Link>
            <Link href="/cek-pesanan"  class="sidebar-link"><span class="fa fa-gamepad me-2 color-orange"></span> Cek Pesanan</Link>
            <Link v-if="customer===null" href="/auth-customer/login"  class="sidebar-link"><span class="fa fa-user me-2 color-orange"></span> Login / Register</Link>
            <Link v-else href="/auth-customer/logout"  class="sidebar-link"><span class="fa fa-user me-2 color-orange"></span> Logout ({{customer.name}})</Link>
        </div>
    </div>
    <nav class="navbar nav-top py-4 navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="d-flex align-items-center">
                <a @click.prevent="openSidebar = !openSidebar" href="" class="color-orange fa-lg text-decoration-none me-5">
                    <span class="fa fa-bars"></span>
                </a>
                <Link class="navbar-brand" href="#"><span class="fas fa-gamepad color-orange me-1"></span> TopUpkuGame</Link>
            </div>
            <Link v-if="customer===null" href="/auth-customer/login" class="text-decoration-none"><span class="fa fa-user me-1"></span> Login / Register</Link>
            <Link v-else href="/auth-customer/logout" class="text-decoration-none"><span class="fa fa-user me-1"></span> Logout ({{customer.name}})</Link>
        </div>
    </nav>    
    <slot/>
    <section id="footer" class="py-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <h4 class="color-orange fw-bold">
                        <span class="fas fa-gamepad me-1"></span> TopUpkuGame                    
                    </h4>
                    <p class="fs-16 color-white mt-3">
                        Top-Up Game Favorit Kamu Di TopUpKuGame Agar Main Game Semakin Seru. Pengiriman Cepat Dan Berbagai Methode Pembayaran Yang Lengkap.                        
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="fs-16 color-orange fw-bold mb-3">PETA SITUS</p>
                            <Link href="/" class="d-block color-white mb-2 fs-16 text-decoration-none">Home</Link>
                            <Link href="/metode-pembayaran" class="d-block color-white mb-2 fs-16 text-decoration-none">Metode Pembayaran</Link>
                            <Link href="/cek-pesanan" class="d-block color-white mb-2 fs-16 text-decoration-none">Cek Pesanan</Link>
                        </div>
                        <div class="col-md-4">
                            <p class="fs-16 color-orange fw-bold mb-3">TOP UP GAME</p>
                            <Link href="/details/mobile-legends" class="d-block color-white mb-2 fs-16 text-decoration-none">Mobile Legend</Link>
                            <Link href="/details/pubg-mobile" class="d-block color-white mb-2 fs-16 text-decoration-none">PUBG Mobile</Link>
                            <Link href="/details/free-fire" class="d-block color-white mb-2 fs-16 text-decoration-none">Free Fire</Link>
                        </div>
                        <div class="col-md-4">
                            <p class="fs-16 color-orange fw-bold mb-3">FOLLOW</p>
                            <a :href="setting.instagram" target="_blank" class="d-block color-white mb-2 fs-16 text-decoration-none"><span class="fab fa-instagram me-1"></span> Instagram</a>
                            <a :href="setting.facebook" target="_blank" class="d-block color-white mb-2 fs-16 text-decoration-none"><span class="fab fa-facebook me-1"></span> Facebook</a>
                            <a :href="setting.twitter" target="_blank" class="d-block color-white mb-2 fs-16 text-decoration-none"><span class="fab fa-twitter me-1"></span> Twitter</a>
                            <a :href="`https://wa.me/${setting.whatsapp}`" target="_blank" class="d-block color-white mb-2 fs-16 text-decoration-none"><span class="fab fa-whatsapp me-1"></span> WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-color:white" class="my-5">
            <div class="row">
                <div class="col">
                    <p class="fs-16 color-white text-center">&copy; Copyright 2023 - TopUpkuGame.com</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
    @import "@/../css/frontend.scss";
</style>
<script>
export default {
    data(){
        return{
            openSidebar : false
        }
    },
    props:{
        customer : Object, 
        setting : Object, 
        title : String 
    },
    watch:{
        title(){
            this.openSidebar = false
        }
    },
    mounted(){
        console.log(this.customer);
    }
}
</script>