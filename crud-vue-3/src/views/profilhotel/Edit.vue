<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT profilhotel</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="nama_hotel" class="font-weight-bold">Nama Hotel</label>
                                <input type="text" class="form-control" v-model="profilhotel.nama_hotel" placeholder="Masukkan Judul profilhotel">
                                <!-- validation -->
                                <div v-if="validation.nama_hotel" class="mt-2 alert alert-danger">
                                    {{ validation.nama_hotel[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomor_kamar" class="font-weight-bold">nomor_kamar</label>
                                <input type="text" class="form-control" v-model="profilhotel.nomor_kamar" placeholder="Masukkan Konten profilhotel">
                                <!-- validation -->
                                <div v-if="validation.nomor_kamar" class="mt-2 alert alert-danger">
                                    {{ validation.nomor_kamar[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_hotel" class="font-weight-bold">alamat_hotel</label>
                                <input type="text" class="form-control" v-model="profilhotel.alamat_hotel" placeholder="Masukkan Konten profilhotel">
                                <!-- validation -->
                                <div v-if="validation.alamat_hotel" class="mt-2 alert alert-danger">
                                    {{ validation.alamat_hotel[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomor_telp" class="font-weight-bold">nomor_telp</label>
                                <input type="text" class="form-control" v-model="profilhotel.nomor_telp" placeholder="Masukkan Konten profilhotel">
                                <!-- validation -->
                                <div v-if="validation.nomor_telp" class="mt-2 alert alert-danger">
                                    {{ validation.nomor_telp[0] }}
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="id_pesanan" class="font-weight-bold">id_pesanan</label>
                                <input type="text" class="form-control" v-model="profilhotel.id_pesanan" placeholder="Masukkan Konten profilhotel">
                                <!-- validation -->
                                <div v-if="validation.id_pesanan" class="mt-2 alert alert-danger">
                                    {{ validation.id_pesanan[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {

    setup() {

        //state posts
        const profilhotel = reactive({
            nama_hotel: '',
            nomor_kamar: '',
            alamat_hotel: '',
            nomor_telp: '',
            id_pesanan: '',
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/profilhotels/${route.params.id}`)
            .then(response => {
              
              //assign state posts with response data
              profilhotel.nama_hotel    = response.data.data.nama_hotel  
              profilhotel.nomor_kamar  = response.data.data.nomor_kamar  
              profilhotel.alamat_hotel  = response.data.data.alamat_hotel 
              profilhotel.nomor_telp   = response.data.data.nomor_telp  
              profilhotel.id_pesanan  = response.data.data.id_pesanan 

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let nama_hotel = profilhotel.nama_hotel
            let nomor_kamar = profilhotel.nomor_kamar
            let alamat_hotel = profilhotel.alamat_hotel
            let nomor_telp = profilhotel.nomor_telp
            let id_pesanan = profilhotel.id_pesanan

            axios.put(`http://localhost:8000/api/profilhotels/${route.params.id}`, {
                nama_hotel: nama_hotel,
                nomor_kamar: nomor_kamar,
                alamat_hotel: alamat_hotel,
                nomor_telp: nomor_telp,
                id_pesanan: id_pesanan 
            }).then(() => {

                //redirect ke profilhotel index
                router.push({
                    name: 'profilhotel.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            profilhotel,
            validation,
            router,
            update
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>