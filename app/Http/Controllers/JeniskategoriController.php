<?php

namespace App\Http\Controllers;

use App\Models\Jeniskategori;
use Illuminate\Http\Request;
use App\Http\Resources\JeniskategoriResource;
use Illuminate\Support\Facades\Validator;

class JeniskategoriController extends Controller
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
        $jeniskategoris = Jeniskategori::latest()->paginate(5);

        //return collection of jeniskategoris as a resource
        return new JeniskategoriResource(true, 'List Data jeniskategoris', $jeniskategoris);
    }
}
