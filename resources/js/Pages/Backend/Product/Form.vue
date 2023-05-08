<template>
    <div class="row">
        <div class="col">
            <div class="card p-3">
                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Nama Produk</label>
                            <input type="text" v-model="form.name" class="form-control" placeholder="Masukkan nama produk disini...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Company</label>
                            <select name="" id="" class="form-control" v-model="form.company_id">
                                <option value="">Pilih Company</option>
                                <option v-for="(data,key) in companies" :key="{key}" :value="{key}">{{data}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Banner</label>
                            <input type="file" class="form-control" ref="banner">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Deskripsi</label>
                            <textarea v-model="form.desc" class="form-control" placeholder="Masukkan deskripsi" name="" rows="3"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div v-for="(data,key) in form.voucher" :key="key" class="row align-items-end">
                        <div class="col-md-3 mb-3">
                            <label for="">Voucher</label>
                            <input type="text" class="form-control" v-model="form.voucher[key]" placeholder="Cth : 112 Diamonds">
                        </div>                        
                        <div class="col-md-3 mb-3">
                            <label for="">Deskripsi</label>
                            <input type="text" class="form-control" v-model="form.description[key]" placeholder="Cth : 100 + 12 Bonus">
                        </div>                        
                        <div class="col-md-3 mb-3">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" placeholder="Cth: 30000"  v-model="form.amount[key]">
                        </div>       
                        <div class="col-md-2 mb-3">
                            <label for="">Keuntungan</label>
                            <input type="number" class="form-control" placeholder="Cth: 5000"  v-model="form.margin[key]">
                        </div>       
                        <div class="col-md-1 mb-3">
                            <button @click="removeField(key)" type="button" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                        </div>       
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button @click="addNew()" type="button" class="btn btn-info btn-sm"><span class="fa fa-plus"></span> Add New</button>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary me-3"><span class="fa fa-save me-1"></span> Simpan</button>                    
                    <button class="btn btn-secondary"><span class="fa fa-save me-1"></span> Reset</button>                    
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import LayoutApp from '@/Layouts/BackofficeLayout.vue'
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    layout: LayoutApp,    
    props:{
        company : Object,
        errors : Object
    },
    setup(props){
        const form = useForm({
            name : '',
            company_id : '',
            banner : '',
            desc : '',
            voucher : [''],
            description : [''],
            amount : [''],
            margin : [''],
        })
        return {form};
    },
    computed:{
        companies(){
            let arr = []
            this.company.map(function(data,key){
                arr[key] = data.name
            })

            return arr
        }
    },
    mounted(){
        console.log(this.errors);
    },
    methods:{
        submit(){
            if (this.$refs.banner) {
                this.form.banner = this.$refs.banner.files[0];
            }
            this.form.post(`/produk`)
        },
        addNew(){
            const lengthArr = this.form.voucher.length 
            this.form.voucher[lengthArr] = ''
            this.form.description[lengthArr] = ''
            this.form.amount[lengthArr] = ''
            this.form.margin[lengthArr] = ''
        },
        removeField(key){
            this.form.voucher.splice(key,1)
            this.form.description.splice(key,1)
            this.form.amount.splice(key,1)
            this.form.margin.splice(key,1)
        }
    }
}
</script>