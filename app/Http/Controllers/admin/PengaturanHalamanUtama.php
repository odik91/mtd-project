<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ElevatorPitch;
use App\Models\HomeFirstThreeItem;
use App\Models\HomeSlider;
use App\Models\OurService;
use App\Models\Suvenir;
use App\Models\Testimoni;
use App\Models\Travel;
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
        $mainServices = HomeFirstThreeItem::get();
        $elevatorPitch = ElevatorPitch::first();
        $ourServices = OurService::get();
        $travels = Travel::get();
        $suvenirs = Suvenir::get();
        $testimonies = Testimoni::get();
        return view('admin.setting-main-page.index', compact('title', 'homeSliders', 'mainServices', 'elevatorPitch', 'ourServices', 'travels', 'suvenirs', 'testimonies'));
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
                'image.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
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
                'image.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
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

    public function editMainServices(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'first_text' => 'required|min:3|max:30',
                'second_text' => 'required|min:3|max:30',
                'third_text' => 'required|min:3|max:30',
                'image' => 'mimes:jpg,bmp,png',
            ],
            [
                'first_text.required' => 'Mohon masukkan nama layanan',
                'first_text.min' => 'Minimal 3 karakter',
                'first_text.max' => 'Anda telah melewati jumlah karakter yang ditentukan max 30 char',
                'second_text.required' => 'Mohon kalimat kedua',
                'second_text.min' => 'Minimal 3 karakter',
                'second_text.max' => 'Anda telah melewati jumlah karakter yang ditentukan max 30 char',
                'third_text.required' => 'Mohon kalimat ketiga',
                'third_text.min' => 'Minimal 3 karakter',
                'third_text.max' => 'Anda telah melewati jumlah karakter yang ditentukan max 30 char',
                'image.mimes' => 'Gambar yang diperbolehkan hanya berformat jpg, bmp dan png',
            ]
        );

        $services = HomeFirstThreeItem::find($id);
        $image = $services['image'];
        $link = !empty($request['link']) ? $request['link'] : $services['link'];

        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/banner/' . $image))) {
                if ($image != 'ban_img1.jpg' || $image != 'ban_img2.jpg' || $image != 'ban_img3.jpg') {
                    unlink(public_path('images/banner/' . $image));
                }
            }

            $image = time() . $request['image']->hashName();
            $pathImage = public_path('/images/banner');
            $resizeImage = Image::make($request['image']->path());
            $resizeImage->resize(300, 364, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $image);
        }

        $data = [
            'first_text' => $request['first_text'],
            'second_text' => $request['second_text'],
            'third_text' => $request['third_text'],
            'link' => $link,
            'image' => $image,
        ];

        $update = $services->update($data);

        if ($update) {
            Session::flash('success', "Layanan utama $services->first_text berhasil diedit");
        } else {
            Session::flash('error', "Layanan utama $services->first_text gagal diedit");
        }

        return redirect()->route('main-settings.index');
    }

    public function editElevatorPitch(Request $request, $id)
    {
        $this->validate($request, [
            'ev-title' => 'min:3|max:100',
            'ev-desc' => 'min:3',
        ]);

        $ev = ElevatorPitch::find($id);

        $data = [
            'title' => $request['ev-title'],
            'content' => $request['ev-desc'],
        ];

        $update = $ev->update($data);
        if ($update) {
            Session::flash('success', "Elevator Pitch berhasil diedit");
        } else {
            Session::flash('error', "Elevator Pitch gagal diedit");
        }

        return redirect()->route('main-settings.index');
    }

    public function OurServices(Request $request)
    {
        $this->validate(
            $request,
            [
                'service_icon' => 'required|min:3',
                'service_name' => 'required|min:3',
                'service_active' => 'required',
            ],
            [
                'service_icon.required' => 'Mohon masukkan font awesome icon',
                'service_icon.min' => 'Service icon minimal 3 karakter',
                'service_name.required' => 'Mohon masukkan nama servis',
                'service_name.min' => 'Nama servis minimal 3 karakter',
                'service_active.required' => 'Mohon pilih salah satu opsi',
            ]
        );

        $data = [
            'service_name' => $request['service_name'],
            'icon' => $request['service_icon'],
            'is_active' => $request['service_active'],
        ];

        $create = OurService::create($data);

        if ($create) {
            Session::flash('success', "Servis berhasil ditambahkan");
        } else {
            Session::flash('error', "Servis gagal ditambahkan");
        }

        return redirect()->route('main-settings.index');
    }

    public function EditOurService(Request $request, $id) {
        $this->validate(
            $request,
            [
                'edit_service_icon' => 'required|min:3',
                'edit_service_name' => 'required|min:3',
                'edit_service_active' => 'required',
            ],
            [
                'edit_service_icon.required' => 'Mohon masukkan font awesome icon',
                'edit_service_icon.min' => 'Service icon minimal 3 karakter',
                'edit_service_name.required' => 'Mohon masukkan nama servis',
                'edit_service_name.min' => 'Nama servis minimal 3 karakter',
                'edit_service_active.required' => 'Mohon pilih salah satu opsi',
            ]
        );

        $service = OurService::find($id);

        $data = [
            'service_name' => $request['edit_service_name'],
            'icon' => $request['edit_service_icon'],
            'is_active' => $request['edit_service_active'],
        ];

        $update = $service->update($data);

        if ($update) {
            Session::flash('success', "Servis $request->edit_service_name berhasil diubah");
        } else {
            Session::flash('error', "Servis $request->edit_service_name gagal diubah");
        }

        return redirect()->route('main-settings.index');
    }

    public function DeleteOurService($id) {
        $service = OurService::find($id);
        $servicename = $service['service_name'];

        $delete = $service->delete();

        if ($delete) {
            Session::flash('success', "Servis $servicename berhasil dihapus");
        } else {
            Session::flash('error', "Servis $servicename gagal dihapus");
        }

        return redirect()->route('main-settings.index');
    }
}
