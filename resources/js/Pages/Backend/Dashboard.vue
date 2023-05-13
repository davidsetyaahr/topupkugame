<template>
    <div class="row">
        <div class="col">
            <div class="alert alert-primary">
                Selamat Datang di Aplikasi Top Up Game
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="box">
                <span class="fa fa-mobile-alt color-orange fa-lg"></span>
                <span class="color-white fw-bold ms-2"> Pesanan Baru</span>
                <hr>
                <h2 class="color-orange">{{countSellNew}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="box">
                <span class="fa fa-gamepad color-orange fa-lg"></span>
                <span class="color-white fw-bold ms-2"> Jumlah Produk</span>
                <hr>
                <h2 class="color-orange">{{countProduct}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="box">
                <span class="fa fa-line-chart color-orange fa-lg"></span>
                <span class="color-white fw-bold ms-2"> Produk Terjual Bln Ini</span>
                <hr>
                <h2 class="color-orange">{{countProductSell}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="box">
                <span class="fa fa-money-bill color-orange fa-lg"></span>
                <span class="color-white fw-bold ms-2"> Keuntungan Bulan Ini</span>
                <hr>
                <h2 class="color-orange">Rp {{formatRupiah(sumProductSell)}}</h2>
            </div>
        </div>
    </div>
</template>
<script>
import LayoutApp from '@/Layouts/BackofficeLayout.vue'
import {formatRupiah,asset} from '@/Utils/MyFunction.js'
export default {
    layout: LayoutApp,    
    props:{
        countSellNew : Number,
        countProduct : Number,
        countProductSell : Number,
        sumProductSell : Number,
    },
    methods:{
        formatRupiah,asset
    },
}
</script>