<template>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="fw-bold color-purple text-center">Order Sukses!</h3>
                    <h5 class="color-orange fw-bold text-center">Kode Pemesanan : {{sell.code}}</h5>
                    <div class="text-center">
                        <span v-if="sell.status === '0'" class="color-purple badge bg-warning">
                            Status Pembayaran : Pending
                        </span>
                        <span v-if="sell.status === '1'" class="badge bg-success">
                            Status Pembayaran : Berhasil
                        </span>
                        <span v-if="sell.status === '2'" class="badge bg-danger">
                            Status Pembayaran : Ditolak
                        </span>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 pe-1 pe-md-2">
                            <div class="box h-100 p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="fs-16 mb-1 fw-bold color-white">{{sell.voucher.title}}</p>
                                        <p class="color-grey mb-0">Rp {{formatRupiah(sell.amount)}}</p>
                                    </div>
                                    <img :src="asset('img/diamon.webp')" width="35" alt="" srcset="">
                                </div>
                                <hr style="border-color:white;opacity:1">
                                <p class="mb-0 fs-16 fw-bold color-orange">
                                    {{sell.voucher.product.name}}
                                </p> 
                            </div>
                        </div>
                        <div class="col-6 ps-1 ps-md-2">
                            <div class="box h-100 p-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="fs-16 mb-1 fw-bold color-white">{{sell.username_game}}</p>
                                        <p class="color-grey mb-0">{{sell.server_id}}</p>
                                    </div>
                                </div>
                                <hr style="border-color:white;opacity:1">
                                <p class="mb-0 fs-16 fw-bold color-orange">
                                    {{sell.payment_method.bank.toUpperCase()}}
                                </p> 
                            </div>
                        </div>
                    </div>
                    <div class="box mt-4 p-4">
                        <center>
                            <h5 class="color-white fw-bold">Lakukan Pembayaran Sekarang!</h5>
                            <hr style="border-color:white;opacity:1">
                            <img :src="storage('payment-method/'+sell.payment_method.img)" class="mb-3" style="width:40%" alt="" srcset="">
                            <h5 class="color-orange fw-bold">{{sell.payment_method.name}}</h5>
                            <div class="fs-16 color-white">{{sell.payment_method.number}}</div>
                            <div class="btn btn-primary color-orange mt-3 fw-bold px-5">Rp {{formatRupiah(sell.amount)}}</div>
                        </center>
                    </div>
                    <div class="box p-4 mt-4" v-if="url">
                        <img :src="url" class="img-fluid" alt="" srcset="">
                    </div>
                    <div class="box p-4 mt-4" v-if="sell.proof_of_payment == null">
                        <label for="" class="mb-2 fw-bold d-block color-orange">Upload Bukti Pembayaran</label>
                        <form @submit.prevent="cekSubmit">
                            <div class="input-group">
                                <input type="file" accept="image/png, image/jpeg, image/jpg"  class="form-control" @change="previewImage" ref="photo">
                                <button class="btn btn-primary px-3 fw-bold" type="submit" id="button-addon2">Submit</button>
                            </div>
                        </form>
                        <div
                            v-if="errors.image"
                            class="mt-3 font-bold text-danger"
                        >
                            {{ errors.image }}
                        </div>                        
                    </div>
                    <div class="box p-4 mt-4" v-else>
                        <img :src="`/storage/proof-of-payment/${sell.proof_of_payment}`" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="confirm-modal" v-if="isConfirm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="confirm">
                        <h5 class="text-center color-purple my-0 fw-bold">Apakah anda yakin?</h5>
                        <p class="fs-16 text-center mt-2">Bukti Pembayaran Akan Dikirim</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="" class="btn btn-secondary px-4" @click.prevent="isConfirm = false"><span class="fa fa-times me-1"></span> Batal</a>
                            <a href="" class="btn btn-primary px-4" @click.prevent="submit">
                                <span v-if="submitted" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </span>                 
                                <span v-else>
                                    Kirim <span class="fa fa-arrow-right ms-1"></span>
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
import {formatRupiah,asset,storage} from '@/Utils/MyFunction.js'
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    layout: LayoutApp,    
    props:{
        sell : Object,
        errors : Object
    },
    data() {
        return {
            url: null,
            isConfirm : false,
            submitted : false,
        }
    },
    setup(props) {
        const form = useForm({
            image: null,
            id : props.sell.id
        });

        return { form };
    },
    methods: {
        cekSubmit(){
            if(this.url != null){
                this.isConfirm = true
            }
            else{
                this.isConfirm = false
            }
        },
        submit() {
            if(!this.submitted){
                this.submitted = true
                this.form.image = this.$refs.photo.files[0];
                this.form.post('../proof-of-payment');
            }
        },
        previewImage(e) {
            const file = e.target.files[0];
            if(typeof file === 'undefined'){
                this.url = null;
            }
            else{
                this.url = URL.createObjectURL(file);
            }
        },
        formatRupiah,asset,storage        
    },    
}
</script>
