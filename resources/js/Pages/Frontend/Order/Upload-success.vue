<template>
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="box mt-4 p-4 text-center">
                        <h3 class="fw-bold color-purple ">Upload Sukses!</h3>
                        <p class="fs-16 color-orange">Anda akan diarahkan ke whatsapp dalam {{counter}}</p>
                        <hr style="border-color:white;opacity:1">
                        <p class="color-grey mb-2">Tidak diarahkan ke whatsapp?</p>
                        <a href="" class="btn btn-success" @click.prevent="openWa"><span class="fab fa-whatsapp me-1"></span> Whatsapp Manual</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import LayoutApp from '@/Layouts/FrontendLayout.vue'
export default {
    layout: LayoutApp,    
    props:{
        setting : Object, 
        sell : Object,
    },
    data(){
        return{
            counter : 7,
        }
    },
    mounted(){
        this.countDown()
    },
    methods: {
        countDown() {
            //If the counter has not reached the end
            if(this.counter > 0) {
                //Wait 1 second, then decrement the counter
                setTimeout(()=>{
                    this.counter--;
                    this.countDown();
                },1000)
            }
            else
            {
                //Count down has reached zero, redirect
                this.openWa()
            }
        },    
        openWa(){
            window.open(`https://wa.me/${this.setting.whatsapp}?text=Halo Topupku Game.%0aSaya ingin konfirmasi pemesanan dengan kode *${this.sell.code}*`,'_blank');
        }
    }    
}
</script>
