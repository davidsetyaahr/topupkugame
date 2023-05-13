<script setup>
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head :title="title" />

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
                <a @click.prevent="openSidebar = !openSidebar" href="" class="color-orange fa-lg text-decoration-none me-4">
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
:root{
    --darkColor : #090715;
    --greyColor : #a6a6a6;
    --darkPurpleColor : #0f0c23;
    --orangeColor : #fd9800;
    --purpleColor : #4826f6;
}
body{
    font-family: 'Poppins', sans-serif;
    background : var(--darkColor);
    font-size:14px;
}
.banner{
    width : 100%;
}
.nav-top{
    background:var(--darkPurpleColor) !important;
    box-shadow : 0 100px 80px hsla(0,0%,89%,.07), 0 41.7776px 33.4221px hsla(0,0%,89%,.05), 0 22.3363px 17.869px hsla(0,0%,89%,.04), 0 12.5216px 10.0172px hsla(0,0%,89%,.04), 0 6.6501px 5.32008px hsla(0,0%,89%,.03), 0 2.76726px 2.21381px hsla(0,0%,89%,.02);
}
.nav-top a,.nav-top{
    color:white;
}
.color-orange{
    color:var(--orangeColor) !important;
}
.color-purple{
    color:var(--purpleColor) !important;
}
.color-grey{
    color:var(--greyColor) !important;
}
.color-white{
    color:white !important;
}
.box{
    border-radius: 15px;
    box-shadow: 0 4px 80px hsla(0,0%,77%,.13), 0 1.6711px 33.4221px hsla(0,0%,77%,.09), 0 0.893452px 17.869px hsla(0,0%,77%,.08), 0 0.500862px 10.0172px hsla(0,0%,77%,.07), 0 0.266004px 5.32008px hsla(0,0%,77%,.05), 0 0.11069px 2.21381px hsla(0,0%,77%,.04);    
}
.card-product{
    position:relative;
    border-radius:15px;
    overflow:hidden;
}
.card-product:hover img{
    transform:scale(1.2);
}
.card-product img{
    width : 100%;
    height : 330px;
    object-fit:cover;
    transition: all.5s ease;
    -webkit-transition: all.5s ease;
    -o-transition: all.5s ease;
    -moz-transition: all.5s ease;
}
.card-product .info p{
    color:white;
    font-size : 15px;
}
.card-product .info{
    background-image: linear-gradient(180deg,rgba(255,255,255,0.1), var(--purpleColor));
    position:absolute;
    width : 100%;
    height : 50%;
    bottom : 0;
    left : 0;
    display:flex;
    flex-direction:column;
    justify-content:flex-end;
    padding : 1rem;
}
.pipe-only{
    width: 40px;
    height: 3px;
    background: var(--orangeColor);    
}
.fs-16{
    font-size:16px;
}
#why{
    background: url("https://i.ytimg.com/vi/vOKKC-9nfZQ/maxresdefault.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;  
    z-index:2;  
}
#why::before{
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: rgba(9,7,21,.85);    
}
.box-icon {
    border: 1px solid #fd9800;
    justify-content: center;
    align-items: center;
    color: #fd9800;
    width: 70px;
    height: 70px;
    font-size: 25px;
    display: flex;
    position: relative;
}
.pipes {
    position: absolute;
    left: 0;
    top: 0;
    width: 200%;
    transform: translate(-25%) rotate(45deg);
    z-index: -1;
    display: flex;
}
.pipes .pipe {
    margin-right: 10px;
    width: 10px;
    height: 80px;
    background: #3f3e47;
}
.btn-circle{
    border-radius:50px;
}
.btn-primary{
    background:var(--purpleColor);
    border-color:var(--purpleColor)
}
#footer{
    background:#100c23
}
.box-number{
    border : 3px solid var(--purpleColor);
    height : 30px;
    width : 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color:white;
    font-size: 18px;
    font-weight: bold;
}
.confirm-modal{
    transition: all.3s ease;
    -webkit-transition: all.3s ease;
    -o-transition: all.3s ease;
    -moz-transition: all.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top : 0;
    left : 0;
    width : 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index : 10000;
}
.confirm{
    background:white;
    border-radius : 30px;
    padding : 1.5rem;
    max-height: 80vh;
    overflow: auto;
}
.sticky-sidebar{
    position: fixed;
    width : 100%;
    height: 100%;
    top :0;
    left :0;
    background: rgba(75,85,99,.75);
    z-index: 100;
    
}
.sticky-sidebar .sidebar{
    background: var(--darkPurpleColor);
    width : 300px;
    height : 100vh;
    display: flex;
    flex-direction: column;

}
.sticky-sidebar .sidebar .sidebar-link,.sidebar-header{
    padding : 0.9rem 1.5rem;
}

.sticky-sidebar .sidebar .sidebar-link{
    font-size: 15px;
    color:white;
    text-decoration: none;
}
.navbar-brand:hover{
    color:white;
}
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