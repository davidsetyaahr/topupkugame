<template>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <img :src="`../storage/banner/${product.top_banner}`" class="img-fluid" alt="" srcset="" style="border-radius:15px">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="box p-4">
                        <div class="row">
                            <div class="col-md-7">
                                <img :src="`../storage/banner/${product.banner}`" class="img-banner-detail" alt="" srcset="">
                            </div>
                        </div>
                        <h5 class="mt-4 fw-bold color-orange">{{product.name}}</h5>
                        <p class="color-white">{{product.description}}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box p-4">
                        <div class="d-flex align-items-center">
                            <div class="box-number me-3">1</div>
                            <h5 class="fw-bold color-orange my-0">
                                Masukkan User ID <small class="ms-2 color-red fs-13">{{err.user_server_id}}</small>
                            </h5>
                        </div>
                        <hr style="border-color:white;opacity:1">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" v-model="form.user_id" placeholder="User ID" class="form-control btn-circle">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" v-model="form.server_id" placeholder="Server ID" class="form-control btn-circle">
                            </div>
                        </div>
                        <p class="color-grey">Silahkan Masukkan User ID & Server Anda Dan Pastikan Benar.</p>
                    </div>
                    <div class="mt-4 box p-4">
                        <div class="d-flex align-items-center">
                            <div class="box-number me-3">2</div>
                            <h5 class="fw-bold color-orange my-0">
                                Pilih Nominal Top Up  <small class="ms-2 color-red fs-13">{{err.voucher_id}}</small>
                            </h5>
                        </div>
                        <hr style="border-color:white;opacity:1">
                        <div class="row">
                            <div class="col-md-4 col-6 mb-3" v-for="(data,key) in product.voucher" :key="key">
                                <div @click="form.voucher_id = data.id" class="card-voucher" :class="form.voucher_id == data.id ? 'active' : '' ">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="fs-16 mb-1 fw-bold color-white">{{data.title}}</p>
                                            <p class="color-grey mb-0">Rp {{formatRupiah(data.amount)}}</p>
                                        </div>
                                        <img :src="asset('img/diamon.webp')" width="35" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 box p-4">
                        <div class="d-flex align-items-center">
                            <div class="box-number me-3">3</div>
                            <h5 class="fw-bold color-orange my-0">
                                Pilih Pembayaran  <small class="ms-2 color-red fs-13">{{err.payment_method}}</small>
                            </h5>
                        </div>
                        <hr style="border-color:white;opacity:1">
                        <div class="row">
                            <div class="col-6">
                                <div :class="form.payment_method == 'BCA' ? 'active' : '' " class="h-100 card-voucher p-md-5 p-3" @click="form.payment_method = 'BCA'">
                                    <img :src="asset('img/bca.webp')" class="img-fluid" alt="" srcset="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div :class="form.payment_method == 'DANA' ? 'active' : '' " class="h-100 card-voucher p-md-5 p-3" @click="form.payment_method = 'DANA'">
                                    <img :src="asset('img/dana.webp')" class="img-fluid" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 box p-4" v-if="customer !== null">
                        <div class="d-flex align-items-center">
                            <div class="box-number me-3">4</div>
                            <h5 class="fw-bold color-orange my-0">
                                Konfirmasi
                            </h5>
                        </div>
                        <hr style="border-color:white;opacity:1">
                        <div class="row">
                            <div class="col-12">
                                <p class="color-grey">Konfirmasi dan lakukan pembayaran</p>
                                <button  @click.prevent="checkConfirm()" class="btn btn-primary px-4 fw-bold btn-circle">Konfirmasi Top Up <span class="fa fa-arrow-right ms-1"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 box p-4" v-else>
                        <div class="d-flex align-items-center">
                            <h5 class="fw-bold color-orange my-0">
                                Login untuk melakukan pemesanan
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="confirm-modal" v-if="isConfirm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="confirm">
                        <h5 class="text-center color-purple my-0 fw-bold">Konfirmasi Top Up</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="radius15 bg-secondary h-100 p-3" style="--bs-bg-opacity:.1">
                                    <p class="fw-bold mb-1 fs-16 color-purple">User ID</p>
                                    <p class="my-0 fs-16">{{form.user_id}}</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="radius15 bg-secondary h-100 p-3" style="--bs-bg-opacity:.1">
                                    <p class="fw-bold mb-1 fs-16 color-purple">Server ID</p>
                                    <p class="my-0 fs-16">{{form.server_id}}</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="radius15 btn-primary h-100 p-3">
                                    <p class="fw-bold mb-1 fs-16 color-orange">Voucher</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="mt-2">
                                            <p class="my-0 fs-16 color-white fw-bold">{{getVoucher().title}}</p>
                                            <p class="my-0 fs-16 color-grey">Rp {{formatRupiah(getVoucher().amount)}}</p>
                                        </div>
                                        <img :src="asset('img/diamon.webp')" width="45" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="radius15 bg-secondary h-100 p-3" style="--bs-bg-opacity:.1">
                                    <p class="fw-bold mb-1 fs-16 color-purple">Pembayaran</p>
                                    <img :src="asset('img/'+form.payment_method.toLowerCase()+'.webp')" class="mt-2" style="width:50%" alt="" srcset="">
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="radius15 bg-secondary h-100 p-3" style="--bs-bg-opacity:.1">
                                    <p class="fw-bold mb-1 fs-16 color-purple">Nama</p>
                                    <p class="my-0 fs-16">{{customer.name}}</p>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="radius15 bg-secondary h-100 p-3" style="--bs-bg-opacity:.1">
                                    <p class="fw-bold mb-1 fs-16 color-purple">Nomor WhatsApp</p>
                                    <p class="my-0 fs-16">{{customer.phone}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="" class="btn btn-secondary px-4" @click.prevent="isConfirm = false"><span class="fa fa-times me-1"></span> Batal</a>
                            <a href="" class="btn btn-primary px-4" @click.prevent="submit()">
                                <span v-if="submitted" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </span>                 
                                <span v-else>
                                    Konfirmasi <span class="fa fa-arrow-right ms-1"></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import LayoutApp from '@/Layouts/FrontendLayout.vue'
import {formatRupiah,asset} from '@/Utils/MyFunction.js'
import { Inertia } from '@inertiajs/inertia'

export default {
    layout: LayoutApp,   
    data(){
        return{
            form : {
                user_id : '',
                server_id : '',
                voucher_id : '',
                payment_method : '',
                customer_id : this.customer !== null ? this.customer.id : '',
            },
            submitted : false,
            isConfirm: false,
            err : {
                user_server_id : null,
                voucher_id : null,
                payment_method : null,
            }
        }
    },
    props:{
        product : Object,
        customer : Object, 
    },
    methods:{
        submit(){
            if(!this.submitted){
                this.submitted = true
                let data = this.form
                Inertia.post('/order', data,{
                    onError:errors => {
                        this.submitted = false
                    }
                })
            }
        },
        checkConfirm(){
            if(this.form.user_id == '' || this.form.server_id == ''){
                this.err.user_server_id = 'User ID & Server ID harus diisi'
            }
            else{
                this.err.user_server_id = null
            }

            if(this.form.voucher_id == ''){
                this.err.voucher_id = 'Silahkan pilih voucher'
            }
            else{
                this.err.voucher_id = null
            }

            if(this.form.payment_method == ''){
                this.err.payment_method = 'Silahkan pilih pembayaran'
            }
            else{
                this.err.payment_method = null
            }


            if(this.err.user_server_id == null && this.err.voucher_id == null && this.err.payment_method == null){
                this.isConfirm = true
            }
            else{
                this.isConfirm = false
                window.scrollTo(0, 0);                
            }
        },
        getVoucher(){
            return this.product.voucher.find(d => d.id == this.form.voucher_id) 
        },
        formatRupiah,asset
    },
}
</script>
<style scoped>
.color-red{
    color:red;
}
.fs-13{
    font-size : 13px;
}
.radius15{
    border-radius: 15px;
}
.img-banner-detail{
    width : 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 15px;
}
.card-voucher{
    border:3px solid transparent;
    background: #1f1e1f;
    padding : 1rem;
    border-radius: 15px;
    cursor: pointer;
    transition: all.3s ease;
    -webkit-transition: all.3s ease;
    -o-transition: all.3s ease;
    -moz-transition: all.3s ease;
}
.card-voucher.active{
    border-color:var(--purpleColor);
    background: var(--orangeColor);
}
.card-voucher:hover{
    background: var(--orangeColor);
}
.card-voucher:hover p.color-grey, .card-voucher.active p.color-grey{
    color: var(--purpleColor) !important;
}
</style>