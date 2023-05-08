<template>
    <div class="row">
        <div class="col">
            <Link href="/produk/create" class="btn btn-primary btn-rounded px-3"><span class="fa fa-plus"></span> Tambah Product</Link>
        </div>
        <div class="col-md-3">
            <Search/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div className="table-responsive">
                <table className="table table-custom">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Product</th>
                            <th>Company</th>
                            <th>Jumlah Voucher</th>
                            <th width="25%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,key) in product" :key="key">
                            <td>{{key+1}}</td>
                            <td>{{data.name}}</td>
                            <td>{{data.company.name}}</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
<script>
import LayoutApp from '@/Layouts/BackofficeLayout.vue'
import Search from '@/Components/Search.vue'
export default {
    layout: LayoutApp,    
    props:{
        product : Object
    },
    components:{
        Search
    }
    
}
</script>