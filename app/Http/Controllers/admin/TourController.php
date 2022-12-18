<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tour & Travel';
        return view('admin.tour-travel.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'travel_name' => 'required|min:3|max:20',
                'second_text' => 'required|min:3|max:30',
                'start_price' => 'required',
                'country' => 'required',
                'region' => 'required',
                'thumbnail' => 'required|mimes:jpg,bmp,png',
                'image' => 'required|mimes:jpg,bmp,png',
                'description' => 'required',
                'is_active' => 'required',
            ],
            [
                'travel_name.required' => 'Nama paket travel tidak boleh kosong',
                'travel_name.min' => 'Nama paket travel minimal 3 karakter',
                'travel_name.max' => 'Nama paket travel melebihi jumlah karakter yang diperbolehkan',
                'second_text.required' => 'Middle text tidak boleh kosong',
                'second_text.min' => 'Middle text minimal 3 karakter',
                'second_text.max' => 'Middle text melebihi jumlah karakter yang diperbolehkan',
                'country.required' => 'Negara tidak boleh kosong',
                'region.required' => 'Region tidak boleh kosong',
                'thumbnail.required' => 'Thumbnail tidak boleh kosong',
                'thumbnail.mimes' => 'Format thumbnail tidak sesuai',
                'image.required' => 'Background tidak boleh kosong',
                'image.mimes' => 'Format background tidak sesuai',
                'description.required' => 'Deskripsi tidak boleh kosong',
                'is_active.required' => 'Status pilihan ditampilkan wajib diisi'
            ]
        );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
