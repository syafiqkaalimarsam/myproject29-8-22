<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $dataagenda = Pesanan::all();
        return view ('pesanan.showpesanan', compact('datapesanan'));

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pesanan.createpesanan');
    }

    // public function create2()
    // {

    // $datanamakelas = Kelas::all();
    // return view('Agenda.createagenda',compact('datanamakelas'));
    // }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nomeja' => 'required',
            'food' => 'required',
            'drink' => 'required',
            'uname' => 'required',
            'metode' => 'required',
        ]);
         Kelas::create([
             'nomeja' => $request->nomeja,
             'food' => $request->food,
             'drink' => $request->drink,
             'uname' => $request->uname,
             'metode' => $request->metode,
         ]);

         return redirect('/kelas')->with('success','Data berhasil ditambahkan!');

        
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
