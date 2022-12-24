<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'About';
        $about = About::first();
        return view('admin.about.index', compact('title', 'about'));
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
                'logo_about' => 'mimes:jpg,bmp,png',
                'logo_slider' => 'mimes:jpg,bmp,png',
                'logo_footer' => 'mimes:jpg,bmp,png',
            ],
            [
                'logo_about.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
                'logo_slider.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
                'logo_footer.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
            ]
        );

        $data = [
            'maps' => null,
            'logo_about' => null,
            'logo_slider' => null,
            'logo_footer' => null,
            'alamat' => $request['alamat'],
            'kelurahan' => $request['kelurahan'],
            'kecamatan' => $request['kecamatan'],
            'kabupaten' => $request['kabupaten'],
            'provinsi' => $request['provinsi'],
        ];

        About::create($data);
        return redirect()->route('about.index');
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
        $this->validate($request, [
            'gmap' => 'required',
            'logo_about' => 'mimes:jpg,bmp,png',
            'logo_slider' => 'mimes:jpg,bmp,png',
            'logo_footer' => 'mimes:jpg,bmp,png',
        ]);
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
