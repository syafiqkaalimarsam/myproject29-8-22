<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
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
        $menus = Menu::latest()->paginate(5);

        //return collection of posts as a resource
        return new MenuResource(true, 'List Data Menus', $menus);
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
            'idmenu'     => 'required',
            'kategori'     => 'required',
            'nama'    => 'required',
            'harga'   => 'required',
            'status'   => 'required',
            'deskripsi'   => 'required',
            'filename'   => 'required',
            'level'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create Menuuuuuu bukan posttt!!!
        $menu = Menu::create([
            'idmenu'     => $request->idmenu,
            'kategori'   => $request->kategori,
            'nama'       => $request->nama,
            'harga'      => $request->harga,
            'status'     => $request->status,
            'deskripsi'  => $request->deskripsi,
            'filename'   => $request->filename,
            'level'      => $request->level,
        ]);

        //return response
        return new MenuResource(true, 'Data Menu Berhasil Ditambahkan!', $menu);
    }
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Menu $menu)
    {
        //return single post as a resource
        return new MenuResource(true, 'Data Menu Ditemukan!', $menu);
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Menu $menu)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kategori'     => 'required',
            'nama'    => 'required',
            'harga'   => 'required',
            'status'   => 'required',
            'deskripsi'   => 'required',
            'filename'   => 'required',
            'level'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('idmenu')) {

            //upload image
            $idmenu = $request->file('idmenu');
            $idmenu->storeAs('public/menus', $idmenu->hashName());

            //delete old image
            Storage::delete('public/menus/'.$menu->idmenu);

            //update post with new image
            $menu->update([
            'idmenu'     => $idmenu->hashName(),
            'kategori'   => $request->kategori,
            'nama'       => $request->nama,
            'harga'      => $request->harga,
            'status'     => $request->status,
            'deskripsi'  => $request->deskripsi,
            'filename'   => $request->filename,
            'level'      => $request->level,
            ]);

        } else {

            //update post without image
            $menu->update([
            'kategori'   => $request->kategori,
            'nama'       => $request->nama,
            'harga'      => $request->harga,
            'status'     => $request->status,
            'deskripsi'  => $request->deskripsi,
            'filename'   => $request->filename,
            'level'      => $request->level,
            ]);
        }

        //return response
        return new MenuResource(true, 'Data Menu Berhasil Diubah!', $menu);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Menu $menu)
    {
        //delete image
        // Storage::delete('public/menus/'.$menu->idmenu);

        //delete post
        $menu->delete();

        //return response
        return new MenuResource(true, 'Data Menu Berhasil Dihapus!', null);
    }
}

