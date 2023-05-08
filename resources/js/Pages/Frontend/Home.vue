<template>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <carousel :items-to-show="1" :wrap-around="true">
                        <slide :index="1">
                            <img src="https://xcashshop.com/_next/image?url=https%3A%2F%2Fsin1.contabostorage.com%2F8ea28123e3b44e7cbd4cf5ad976f428b%3Axc-assets%2Fmedia%2Ffile-1679825274-v6rs9n0d-xc-new-banner-website-1-11-1.png&w=1080&q=75" class="banner" alt="" srcset="">
                        </slide>
                        <slide :index="2">
                            <img src="https://xcashshop.com/_next/image?url=https%3A%2F%2Fsin1.contabostorage.com%2F8ea28123e3b44e7cbd4cf5ad976f428b%3Axc-assets%2Fmedia%2Ffile-1679825274-v6rs9n0d-xc-new-banner-website-1-11-1.png&w=1080&q=75" class="banner" alt="" srcset="">
                        </slide>

                        <template #addons>
                        <navigation />
                        <pagination />
                        </template>
                    </carousel>                    
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="d-flex align-items-center">
                        <div class="pipe-only"></div>
                        <h3 class="ms-2 my-0 fw-bold color-white">Top Up Game Now!</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3" v-for="(data,key) in product" :key="key">
                    <a :href="`details/${data.url}`">
                        <div class="card-product">
                            <img :src="`storage/banner/${data.banner}`" alt="">
                            <div class="info">
                                <h5 class="fw-bold mb-0 color-orange">{{data.name}}</h5>
                                <p class="mb-0 mt-1">{{data.company.name}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>    
    <section class="py-5 mt-5" id="why">
        <div class="container my-2">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="pipe-only"></div>
                        <h3 class="ms-2 my-0 fw-bold color-white">Kenapa Harus TopUpKu Game?</h3>
                    </div>
                    <p class="color-grey mt-2 fs-16">
                        Kami sudah terbukti terpercaya dalam melayani pelanggan kami.
                    </p>
                    <a href="" class="btn btn-primary px-4 btn-sm py-3 fw-bold btn-circle mt-2">Top Up Sekarang!</a>
                </div>
                <div class="col-md-6">
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="box-icon">
                                <div class="pipes">
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                </div>
                                <span class="fa fa-mobile-alt"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ms-3">
                                <h5 class="fw-bold color-orange">Transaksi Mudah</h5>
                                <p class="fs-16 color-white">Hanya lewat telepon genggam, anda bisa melakukan transaksi</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="box-icon">
                                <div class="pipes">
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                </div>
                                <span class="fa fa-bolt"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ms-3">
                                <h5 class="fw-bold color-orange">Transaksi Cepat</h5>
                                <p class="fs-16 color-white">Kami akan selalu siap 24 jam untuk melayani anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="box-icon">
                                <div class="pipes">
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                    <div class="pipe"></div>
                                </div>
                                <span class="fa fa-tag"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ms-3">
                                <h5 class="fw-bold color-orange">Banyak Promo Menarik</h5>
                                <p class="fs-16 color-white">Nantikan akan banyak sekali promo menarik untuk anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import LayoutApp from '@/Layouts/FrontendLayout.vue'

export default {
    layout: LayoutApp,    
    props:{
        product : Object
    },
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
  },
}
</script>
<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>