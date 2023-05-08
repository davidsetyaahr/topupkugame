<template>
    <form @submit.prevent="search">
        <div class="input-group mb-3">
            <input type="text" v-model="keySearch.key"  class="form-control py-2" placeholder="Cari data disini..." aria-label="Cari data disini..." aria-describedby="button-addon2">
            <button class="btn btn-primary" type="submit" id="button-addon2"><span class="fa fa-search"></span> </button>
        </div>
    </form>
</template>

<style scoped>
    .py-2{
        padding:.6rem 1.25rem !important;
    }
</style>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'    

export default {
    setup(props){
        const params = new URLSearchParams(window.location.search)

        const keySearch = reactive({
            key:params.get('key')
        })

        function search() {

            //define variable 
            let key   = keySearch.key

            //send data
            Inertia.get('', {
                key: key,
            })
        }        

        return {
            keySearch,search
        }
    }
}
</script>