<?php

namespace App\Http\Controllers;

use App\Models\Profilhotel;
use Illuminate\Http\Request;
use App\Http\Resources\ProfilhotelResource;
use Illuminate\Support\Facades\Validator;

class ProfilhotelController extends Controller
{
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table profilhotels
        $profilhotels = Profilhotel::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data profilhotel',
            'data'    => $profilhotels  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find profilhotel by ID
        $profilhotel = Profilhotel::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data profilhotel',
            'data'    => $profilhotel 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_hotel'       => 'required',
            'nomor_kamar'      => 'required',
            'alamat_hotel'     => 'required',
            'nomor_telp'       => 'required',
            'id_pesanan'       => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $profilhotel = profilhotel::create([
            'nama_hotel'      => $request->nama_hotel,
            'nomor_kamar'     => $request->nomor_kamar,
            'alamat_hotel'    => $request->alamat_hotel,
            'nomor_telp'      => $request->nomor_telp,
            'id_pesanan'      => $request->id_pesanan
        ]);

        //success save to database
        if($profilhotel) {

            return response()->json([
                'success' => true,
                'message' => 'profilhotel Created',
                'data'    => $profilhotel  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'profilhotel Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $profilhotel
     * @return void
     */
    public function update(Request $request, Profilhotel $profilhotel)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_hotel'       => 'required',
            'nomor_kamar'      => 'required',
            'alamat_hotel'     => 'required',
            'nomor_telp'       => 'required',
            'id_pesanan'       => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find profilhotel by ID
        $profilhotel = Profilhotel::findOrFail($profilhotel->id);

        if($profilhotel) {

            //update profilhotel
            $profilhotel->update([
                'nama_hotel'      => $request->nama_hotel,
                'nomor_kamar'     => $request->nomor_kamar,
                'alamat_hotel'    => $request->alamat_hotel,
                'nomor_telp'      => $request->nomor_telp,
                'id_pesanan'      => $request->id_pesanan
            ]);

            return response()->json([
                'success' => true,
                'message' => 'profilhotel Updated',
                'data'    => $profilhotel  
            ], 200);

        }

        //data profilhotel not found
        return response()->json([
            'success' => false,
            'message' => 'profilhotel Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find profilhotel by ID
        $profilhotel = Profilhotel::findOrfail($id);

        if($profilhotel) {

            //delete profilhotel
            $profilhotel->delete();

            return response()->json([
                'success' => true,
                'message' => 'profilhotel Deleted',
            ], 200);

        }

        //data profilhotel not found
        return response()->json([
            'success' => false,
            'message' => 'profilhotel Not Found',
        ], 404);
    }

}
