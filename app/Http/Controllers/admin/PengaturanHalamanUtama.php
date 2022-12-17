<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengaturanHalamanUtama extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengaturan Halaman Utama';
        $homeSliders = HomeSlider::get();
        return view('admin.setting-main-page.index', compact('title', 'homeSliders'));
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
                'first_text' => 'required',
                'second_text' => 'required',
                'third_text' => 'required',
                'image' => 'required|mimes:jpg,bmp,png',
                'is_active' => 'required'
            ],
            [
                'first_text.required' => 'Judul tidak boleh kosong',
                'second_text.required' => 'Slogan tidak boleh kosong',
                'third_text.required' => 'Ajakan tidak boleh kosong',
                'image.required' => 'Background tidak boleh kosong',
                'image.mimes' => 'Gambar yang diperbolehkan haya berformat jpg, bmp dan png',
                'is-active.required' => 'Mohon pilih opsi yang tepat untuk field ini'
            ]
        );

        $image = null;
        $link = !empty($request['link']) ? $request['link'] : '#';

        if ($request->hasFile('image')) {
            $image = time() . $request['image']->hashName();
            $pathImage = public_path('/images/sliders');
            $resizeImage = Image::make($request['image']->path());
            $resizeImage->resize(2050, 992, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $image);
        }

        $datum = [
            'first_text' => $request['first_text'],
            'second_text' => $request['second_text'],
            'third_text' => $request['third_text'],
            'link' => $link,
            'image' => $image,
            'is_active' => $request['is_active']
        ];

        $create = HomeSlider::create($datum);

        if ($create) {
            Session::flash('success', "Slider berhasil ditambahkan");
        } else {
            Session::flash('error', "Slider gagal ditambahkan");
        }

        return redirect()->route('main-settings.index');
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
        $this->validate(
            $request,
            [
                'first_text' => 'required',
                'second_text' => 'required',
                'third_text' => 'required',
                'image' => 'mimes:jpg,bmp,png',
                'is_active' => 'required'
            ],
            [
                'first_text.required' => 'Judul tidak boleh kosong',
                'second_text.required' => 'Slogan tidak boleh kosong',
                'third_text.required' => 'Ajakan tidak boleh kosong',
                'image.required' => 'Background tidak boleh kosong',
                'image.mimes' => 'Gambar yang diperbolehkan haya berformat jpg, bmp dan png',
                'is-active.required' => 'Mohon pilih opsi yang tepat untuk field ini'
            ]
        );

        $oldData = HomeSlider::find($id);
        $image = $oldData['image'];
        $link = $oldData['link'];

        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/sliders/' . $image))) {
                unlink(public_path('images/sliders/' . $image));
            }

            $image = time() . $request['image']->hashName();
            $pathImage = public_path('/images/sliders');
            $resizeImage = Image::make($request['image']->path());
            $resizeImage->resize(2050, 992, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $image);
        }

        $data = [
            'first_text' => $request['first_text'],
            'second_text' => $request['second_text'],
            'third_text' => $request['third_text'],
            'link' => $link,
            'image' => $image,
            'is_active' => $request['is_active']
        ];

        $update = $oldData->update($data);

        if ($update) {
            Session::flash('success', "Slider $oldData->first_text berhasil diedit");
        } else {
            Session::flash('error', "Slider $oldData->first_text gagal diedit");
        }

        return redirect()->route('main-settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = HomeSlider::where('id', $id);
        $sliderName = $slider->first()->first_text;
        $delete = $slider->delete();

        if ($delete) {
            Session::flash('success', "Slider $sliderName berhasil dihapus");
        } else {
            Session::flash('error', "Slider $sliderName gagal dihapus");
        }

        return redirect()->route('main-settings.index');
    }
}
