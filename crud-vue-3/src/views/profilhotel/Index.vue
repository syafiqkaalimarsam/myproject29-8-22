<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>DATA POST</h4>
                        <hr>
                        <router-link :to="{ name: 'profilhotel.create' }" class="btn btn-md btn-success">TAMBAH POST
                        </router-link>

                        <table class="table table-striped table-dark mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Hotel</th>
                                    <th scope="col">Nomor Kamar</th>
                                    <th scope="col">Alamat Hotel</th>
                                    <th scope="col">Nomor Telpon</th>
                                    <th scope="col">ID Pesanan</th>
                                    <th scope="col">OPTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(profilhotel, index) in profilhotels" :key="index">
                                    <td>{{  profilhotel.nama_hotel  }}</td>
                                    <td>{{  profilhotel.nomor_kamar  }}</td>
                                    <td>{{  profilhotel.alamat_hotel  }}</td>
                                    <td>{{  profilhotel.nomor_telp  }}</td>
                                    <td>{{  profilhotel.id_pesanan  }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'profilhotel.edit', params: { id: profilhotel.id } }"
                                            class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="postDelete(profilhotel.id)"
                                            class="btn btn-sm btn-danger ml-1"> DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    name: 'index',

    setup() {

        //reactive state
        let profilhotels = ref([])

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get('http://localhost:8000/api/profilhotels')
                .then(response => {

                    //assign state posts with response data
                    profilhotels.value = response.data.data

                }).catch(error => {
                    console.log(error.response.data)
                })

        })

        //method delete
        function postDelete(id) {

            //delete data post by ID
            axios.delete(`http://localhost:8000/api/profilhotels/${id}`)
                .then(() => {

                    //splice profihotels 
                    profilhotels.value.splice(profihotels.value.indexOf(id), 1);

                }).catch(error => {
                    console.log(error.response.data)
                })

        }

        //return
        return {
            profilhotels,
            postDelete
        }

    }

}
</script>

<style>
body {
    background: lightgray;
}
</style>