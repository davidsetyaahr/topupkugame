<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="box p-4">
                        <div v-if="customer != null" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Game</th>
                                        <th>Voucher</th>
                                        <th>User ID</th>
                                        <th>Server ID</th>
                                        <th>Total</th>
                                        <th>Pembayaran</th>
                                        <th>Bukti Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data,key) in sell" :key="key">
                                        <td>{{key+1}}</td>
                                        <td>{{data.voucher.product.name}}</td>
                                        <td>{{data.voucher.title}}</td>
                                        <td>{{data.username_game}}</td>
                                        <td>{{data.server_id}}</td>
                                        <td>Rp {{formatRupiah(data.amount)}}</td>
                                        <td>{{data.payment_method.name}}</td>
                                        <td>
                                            <Link :href="`/order-success/${data.url}`">Cek Disini</Link>
                                        </td>
                                        <td>
                                            <span v-if="data.status === '0'" class="color-purple badge bg-warning">
                                                Pending
                                            </span>
                                            <span v-if="data.status === '1'" class="badge bg-success">
                                                Berhasil
                                            </span>
                                            <span v-if="data.status === '2'" class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="alert alert-danger fw-bold">Login untuk mengecek pemesanan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import LayoutApp from '@/Layouts/FrontendLayout.vue'
import {formatRupiah} from '@/Utils/MyFunction.js'

export default {
    layout: LayoutApp,    
    props:{
        customer : Object,
        sell : Object
    },
    methods:{
        formatRupiah
    },
    data(){
        return{
        }
    },
}
</script>
<style scoped>
    td,th{
        color:white;
    }
    tr:hover td{
        color:white
    }
</style>