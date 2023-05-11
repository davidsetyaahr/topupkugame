<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3" v-for="(data,key) in paymentMethod" :key="key">
                    <div class="box p-4 h-100">
                        <img style="width:200px" :src="asset('img/'+data.bank.toLowerCase()+'.webp')"/>
                        <hr style="border-color:white;opacity:.5">
                        <h5 class="fw-bold color-orange">{{data.name}}</h5>
                        <h5 class="fw-bold color-orange">{{data.number}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import LayoutApp from '@/Layouts/FrontendLayout.vue'
import {asset} from '@/Utils/MyFunction.js'

export default {
    layout: LayoutApp,    
    props:{
        paymentMethod : Object
    },
    methods:{
        asset
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