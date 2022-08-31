<?php

namespace App\Http\Controllers;

use App\Models\Profilhotel;
use Illuminate\Http\Request;
use App\Http\Resources\ProfilhotelResource;
use Illuminate\Support\Facades\Validator;

class ProfilhotelController extends Controller
{
    //
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $profilhotels = Profilhotel::latest()->get();

        //return collection of posts as a resource
        return new ProfilhotelResource(true, 'List Data profilhotels', $profilhotels);
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_hotel'       => 'required',
            'nomor_kamar'      => 'required',
            'alamat_hotel'     => 'required',
            'nomor_telp'       => 'required',
            'id_pesanan'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create profilhoteluuuuu bukan posttt!!!
        $profilhotel = Profilhotel::create([
            'nama_hotel'      => $request->nama_hotel,
            'nomor_kamar'     => $request->nomor_kamar,
            'alamat_hotel'    => $request->alamat_hotel,
            'nomor_telp'      => $request->nomor_telp,
            'id_pesanan'      => $request->id_pesanan,
        ]);

        //return response
        return new ProfilhotelResource(true, 'Data profilhotel Berhasil Ditambahkan!', $profilhotel);
    }
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Profilhotel $profilhotel)
    {
        //return single post as a resource
        return new ProfilhotelResource(true, 'Data profilhotel Ditemukan!', $profilhotel);
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, profilhotel $profilhotel)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_hotel'       => 'required',
            'nomor_kamar'      => 'required',
            'alamat_hotel'     => 'required',
            'nomor_telp'       => 'required',
            'id_pesanan'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('nama_hotel')) {

            //upload image
            $nama_hotel = $request->file('nama_hotel');
            $nama_hotel->storeAs('public/profilhotels', $nama_hotel->hashName());

            //delete old image
            Storage::delete('public/profilhotels/'.$profilhotel->nama_hotel);

            //update post with new image
            $profilhotel->update([
            'nama_hotel'     => $nama_hotel->hashName(),
            'nomor_kamar'     => $request->nomor_kamar,
            'alamat_hotel'    => $request->alamat_hotel,
            'nomor_telp'      => $request->nomor_telp,
            'id_pesanan'      => $request->id_pesanan,
            ]);

        } else {

            //update post without image
            $profilhotel->update([
                'nomor_kamar'     => $request->nomor_kamar,
                'alamat_hotel'    => $request->alamat_hotel,
                'nomor_telp'      => $request->nomor_telp,
                'id_pesanan'      => $request->id_pesanan,
            ]);
        }

        //return response
        return new ProfilhotelResource(true, 'Data profilhotel Berhasil Diubah!', $profilhotel);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Profilhotel $profilhotel)
    {
        //delete image
        // Storage::delete('public/profilhotels/'.$profilhotel->nama_hotel);

        //delete post
        $profilhotel->delete();

        //return response
        return new ProfilhotelResource(true, 'Data profilhotel Berhasil Dihapus!', null);
    }
}

