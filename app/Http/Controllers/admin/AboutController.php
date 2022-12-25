<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ContactPerson;
use App\Models\ElevatorPitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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
        $elevatorPitch = ElevatorPitch::first();
        $contacts = ContactPerson::get();
        return view('admin.about.index', compact('title', 'about', 'elevatorPitch', 'contacts'));
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

        $oldAbout = About::find($id);

        $logo_about = $oldAbout['logo_about'];
        $logo_slider = $oldAbout['logo_slider'];
        $logo_footer = $oldAbout['logo_footer'];

        if ($request->hasFile('logo_about')) {
            if (isset($oldAbout['logo_about']) && file_exists(public_path('images/logo/' . $oldAbout['logo_about']))) {
                unlink(public_path('images/logo/' . $oldAbout['logo_about']));
            }

            $logo_about = time() . $request['logo_about']->hashName();
            $pathImage = public_path('/images/logo');
            $resizeImage = Image::make($request['logo_about']->path());
            $resizeImage->resize(500, 500, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $logo_about);
        }

        if ($request->hasFile('logo_slider')) {
            if (isset($oldAbout['logo_slider']) && file_exists(public_path('images/logo/' . $oldAbout['logo_slider']))) {
                unlink(public_path('images/logo/' . $oldAbout['logo_slider']));
            }

            $logo_slider = time() . $request['logo_slider']->hashName();
            $pathImage = public_path('/images/logo');
            $resizeImage = Image::make($request['logo_slider']->path());
            $resizeImage->resize(500, 500, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $logo_slider);
        }

        if ($request->hasFile('logo_footer')) {
            if (isset($oldAbout['logo_footer']) && file_exists(public_path('images/logo/' . $oldAbout['logo_footer']))) {
                unlink(public_path('images/logo/' . $oldAbout['logo_footer']));
            }

            $logo_footer = time() . $request['logo_footer']->hashName();
            $pathImage = public_path('/images/logo');
            $resizeImage = Image::make($request['logo_footer']->path());
            $resizeImage->resize(500, 500, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $logo_footer);
        }

        $map = $request['gmap'] == '' ? $oldAbout['maps'] : $request['gmap'];
        $alamat = $request['alamat'] == '' ? $oldAbout['alamat'] : $request['alamat'];
        $kelurahan = $request['kelurahan'] == '' ? $oldAbout['kelurahan'] : $request['kelurahan'];
        $kecamatan = $request['kecamatan'] == '' ? $oldAbout['kecamatan'] : $request['kecamatan'];
        $kabupaten = $request['kabupaten'] == '' ? $oldAbout['kabupaten'] : $request['kabupaten'];
        $provinsi = $request['provinsi'] == '' ? $oldAbout['provinsi'] : $request['provinsi'];

        $data = [
            'maps' => $map,
            'logo_about' => $logo_about,
            'logo_slider' => $logo_slider,
            'logo_footer' => $logo_footer,
            'alamat' => $request['alamat'],
            'kelurahan' => $request['kelurahan'],
            'kecamatan' => $request['kecamatan'],
            'kabupaten' => $request['kabupaten'],
            'provinsi' => $request['provinsi'],
        ];

        $update = $oldAbout->update($data);

        if ($update) {
            Session::flash('success', "Informasi about berhasil ditambahkan");
        } else {
            Session::flash('error', "Informasi about gagal ditambahkan");
        }

        return redirect()->route('about.index');
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

    public function saveContact(Request $request)
    {
        $this->validate(
            $request,
            [
                'contact_media' => 'required',
                'contact' => 'required|min:3|max:40',
                'primary' => 'required'
            ],
            [
                'contact_media.required' => 'Harap pilih salah satu opsi media',
                'contact.required' => 'Harap masukkan kontak anda',
                'contact.min' => 'Minimal 3 karakter',
                'contact.max' => 'Minimal 40 karakter',
                'primary.required' => 'Harap pilih salah satu opsi',
            ]
        );

        $data = [
            'contact_media' => $request['contact_media'],
            'contact' => $request['contact'],
            'primary' => $request['primary']
        ];

        $create = ContactPerson::create($data);

        if ($create) {
            Session::flash('success', "Kontak berhasil ditambahkan");
        } else {
            Session::flash('error', "Kontak gagal ditambahkan");
        }

        return redirect()->route('about.index');
    }

    public function editContact(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'contact_media_edit' => 'required',
                'contact_edit' => 'required|min:3|max:40',
                'primary_edit' => 'required'
            ],
            [
                'contact_media_edit.required' => 'Harap pilih salah satu opsi media',
                'contact_edit.required' => 'Harap masukkan kontak anda',
                'contact_edit.min' => 'Minimal 3 karakter',
                'contact_edit.max' => 'Minimal 40 karakter',
                'primary.required' => 'Harap pilih salah satu opsi',
            ]
        );

        $contact = ContactPerson::find($id);

        $data = [
            'contact_media' => $request['contact_media_edit'],
            'contact' => $request['contact_edit'],
            'primary' => $request['primary_edit']
        ];

        $update = $contact->update($data);

        if ($update) {
            Session::flash('success', "Kontak berhasil diubah");
        } else {
            Session::flash('error', "Kontak gagal diubah");
        }

        return redirect()->route('about.index');
    }

    public function deleteContact($id) {
        $contact = ContactPerson::find($id);
        $contactInfo = $contact['contact'];

        $delete = $contact->delete();

        if ($delete) {
            Session::flash('success', "Kontak $contactInfo berhasil dihapus");
        } else {
            Session::flash('error', "Kontak $contactInfo gagal dihapus");
        }

        return redirect()->route('about.index');
    }
}
