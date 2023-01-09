<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
        $travels = Travel::get();
        $selectTravels = Travel::orderBy('travel_name', 'asc')->get();
        $travelPackages = TravelPackage::get();
        return view('admin.tour-travel.index', compact('title', 'travels', 'selectTravels', 'travelPackages'));
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

    private function _resizeImage($requestImage, $resX, $resY, $path)
    {
        $imageName = time() . $requestImage->hashName();
        $pathImage = public_path($path);
        $resizeImage = Image::make($requestImage->path());
        $resizeImage->resize($resX, $resY, function ($const) {
            $const->aspectRatio();
        })->save($pathImage . '/' . $imageName);
        return $imageName;
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
                'country' => 'required|min:3|',
                'region' => 'required|min:3|',
                'meta_description' => 'required|min:3|',
                'meta_keywords' => 'required|min:3|',
                'seo_title' => 'required|min:3|',
                'thumbnail' => 'required|mimes:jpg,bmp,png',
                'image' => 'required|mimes:jpg,bmp,png',
                'travel_description' => 'required',
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
                'meta_description.required' => 'Meta description tidak boleh kosong',
                'meta_description.min' => 'Minimal 3 karakter',
                'meta_keywords.required' => 'Meta keyword tidak boleh kosong',
                'meta_keywords.min' => 'Minimal 3 karakter',
                'seo_title.required' => 'Seo title tidak boleh kosong',
                'seo_title.min' => 'Minimal 3 karakter',
                'thumbnail.required' => 'Thumbnail tidak boleh kosong',
                'thumbnail.mimes' => 'Format thumbnail tidak sesuai',
                'image.required' => 'Background tidak boleh kosong',
                'image.mimes' => 'Format background tidak sesuai',
                'travel_description.required' => 'Deskripsi tidak boleh kosong',
                'is_active.required' => 'Status pilihan ditampilkan wajib diisi',
            ]
        );

        $content = $request['travel_description'];

        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $imageFiles = $dom->getElementsByTagName('img');
        $arrImg = [];
        foreach ($imageFiles as $key => $imageFile) {
            $data = $imageFile->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list($e, $data) = explode(',', $data);
            $imageData[$key] = base64_decode($data);
            $uniqueName = date_timestamp_get(date_create());
            $imageName[$key] = date('timestamp') . time() . $uniqueName . $imageFiles[$key]->getAttribute('data-filename');
            $path = public_path() . '/images/destination/' . $imageName[$key];
            file_put_contents($path, $imageData[$key]);
            $imageFile->removeAttribute('src');
            $imageFile->setAttribute('src', '/images/destination/' . $imageName[$key]);
            array_push($arrImg, $imageName[$key]);
        }

        $content = $dom->saveHTML();

        $thumbnail = null;
        $image = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->_resizeImage($request['thumbnail'], 364, 364, '/images/destination');
        }

        if ($request->hasFile('image')) {
            $image = $this->_resizeImage($request['image'], 1280, 1280, '/images/destination');
        }

        $slug = 'mame tirta dewata wisata ' . $request['travel_name'];

        $data = [
            'travel_name' => $request['travel_name'],
            'second_text' => $request['second_text'],
            'start_price' => $request['start_price'],
            'country' => $request['country'],
            'region' => $request['region'],
            'thumbnail' => $thumbnail,
            'image' => $image,
            'description' => $content,
            'meta_description' => $request['meta_description'],
            'meta_keywords' => $request['meta_keywords'],
            'seo_title' => $request['seo_title'],
            'is_active' => $request['is_active'],
            'slug' => Str::slug($slug)
        ];

        $create = Travel::create($data);

        if ($create) {
            Session::flash('success', "Destinasi wisata berhasil ditambahkan");
        } else {
            Session::flash('error', "Destinasi wisata gagal ditambahkan");
        }

        return redirect()->route('tour-travel.index');
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
                'edit_travel_name' => 'required|min:3|max:20',
                'edit_second_text' => 'required|min:3|max:30',
                'edit_start_price' => 'required',
                'edit_country' => 'required|min:3|',
                'edit_region' => 'required|min:3|',
                'meta_description_edit' => 'required|min:3|',
                'meta_keywords_edit' => 'required|min:3|',
                'seo_title_edit' => 'required|min:3|',
                'edit_thumbnail' => 'mimes:jpg,bmp,png',
                'edit_image' => 'mimes:jpg,bmp,png',
                'edit_description' => 'required',
                'edit_is_active' => 'required',
            ],
            [
                'edit_travel_name.required' => 'Nama paket travel tidak boleh kosong',
                'edit_travel_name.min' => 'Nama paket travel minimal 3 karakter',
                'edit_travel_name.max' => 'Nama paket travel melebihi jumlah karakter yang diperbolehkan',
                'edit_second_text.required' => 'Middle text tidak boleh kosong',
                'edit_second_text.min' => 'Middle text minimal 3 karakter',
                'edit_second_text.max' => 'Middle text melebihi jumlah karakter yang diperbolehkan',
                'edit_country.required' => 'Negara tidak boleh kosong',
                'edit_region.required' => 'Region tidak boleh kosong',
                'meta_description_edit.required' => 'Meta description tidak boleh kosong',
                'meta_description_edit.min' => 'Minimal 3 karakter',
                'meta_keywords_edit.required' => 'Meta keyword tidak boleh kosong',
                'meta_keywords_edit.min' => 'Minimal 3 karakter',
                'seo_title_edit.required' => 'Seo title tidak boleh kosong',
                'seo_title_edit.min' => 'Minimal 3 karakter',
                'edit_thumbnail.mimes' => 'Format thumbnail tidak sesuai',
                'edit_image.mimes' => 'Format background tidak sesuai',
                'edit_description.required' => 'Deskripsi tidak boleh kosong',
                'edit_is_active.required' => 'Status pilihan ditampilkan wajib diisi'
            ]
        );

        $travel = Travel::find($id);
        $thumbnail = $travel['thumbnail'];
        $image = $travel['image'];

        $oldContent = $travel['description'];

        $domOldArticle = new \DOMDocument();
        $domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | libxml_use_internal_errors(true));
        $findImages = $domOldArticle->getElementsByTagName('img');
        $oldImages = [];

        foreach ($findImages as $key => $findImage) {
            $data = $findImage->getAttribute('src');
            $data = explode('/', $data);
            array_push($oldImages, $data[3]);
        }

        $content = $request['edit_description'];
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $imageFiles = $dom->getElementsByTagName('img');
        $arrayImage = [];

        foreach ($imageFiles as $key => $imageFile) {
            $data = $imageFile->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list($e, $data) = explode(',', $data);
            $imageData[$key] = base64_decode($data);
            $uniqueName = date_timestamp_get(date_create());
            $imageName[$key] = date('timestamp') . time() . $key . $uniqueName . $imageFiles[$key]->getAttribute('data-filename');
            $path = public_path() . "/images/destination/" . $imageName[$key];
            file_put_contents($path, $imageData[$key]);
            $imageFile->removeAttribute('src');
            $imageFile->setAttribute('src', '/images/destination/' . $imageName[$key]);
            array_push($arrayImage, $imageName[$key]);
        }

        $content = $dom->saveHTML();

        // check if image is not used in post
        $checkNewImage =  new \DOMDocument();
        $checkNewImage->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $newImages = $dom->getElementsByTagName('img');
        $newArrayImages = [];
        foreach ($newImages as $key => $newImage) {
            $data = $newImage->getAttribute('src');
            $data = explode('/', $data);
            if (isset($data[3])) {
                $name = $data[3];
                array_push($newArrayImages, $name);
            } else {
                array_push($newArrayImages, $data[0]);
            }
        }

        if ($request->hasFile('edit_thumbnail')) {
            if (file_exists(public_path('images/destination/' . $thumbnail))) {
                unlink(public_path('images/destination/' . $thumbnail));
            }
            $thumbnail = $this->_resizeImage($request['edit_thumbnail'], 364, 364, '/images/destination');
        }

        if ($request->hasFile('edit_image')) {
            if (file_exists(public_path('images/destination/' . $image))) {
                unlink(public_path('images/destination/' . $image));
            }
            $image = $this->_resizeImage($request['edit_image'], 1280, 1280, '/images/destination');
        }

        $slug = 'mame tirta dewata wisata ' . $request['edit_travel_name'];

        $data = [
            'travel_name' => $request['edit_travel_name'],
            'second_text' => $request['edit_second_text'],
            'start_price' => $request['edit_start_price'],
            'country' => $request['edit_country'],
            'region' => $request['edit_region'],
            'thumbnail' => $thumbnail,
            'image' => $image,
            'description' => $content,
            'meta_description' => $request['meta_description_edit'],
            'meta_keywords' => $request['meta_keywords_edit'],
            'seo_title' => $request['seo_title_edit'],
            'is_active' => $request['edit_is_active'],
            'slug' => Str::slug($slug)
        ];

        $update = $travel->update($data);

        if ($update) {
            $arrayRemoveimage = array_diff($oldImages, $newArrayImages);
            $arrayRemoveimage = implode("/", $arrayRemoveimage);
            $arrayRemoveimage = explode("/", $arrayRemoveimage);
            if (sizeof($arrayRemoveimage) > 0) {
                for ($i = 0; $i < sizeof($arrayRemoveimage); $i++) {
                    if ($arrayRemoveimage[$i] != "") {
                        if (file_exists(public_path("images/destination/{$arrayRemoveimage[$i]}"))) {
                            unlink(public_path("images/destination/{$arrayRemoveimage[$i]}"));
                        }
                    }
                }
            }
            Session::flash('success', "Destinasi wisata berhasil diedit");
        } else {
            Session::flash('error', "Destinasi wisata gagal diedit");
        }

        return redirect()->route('tour-travel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel = Travel::find($id);
        $travelName = $travel['travel_name'];
        $delete = $travel->delete();

        if ($delete) {
            Session::flash('success', "Destinasi wisata $travelName berhasil dihapus");
        } else {
            Session::flash('error', "Destinasi wisata $travelName gagal dihapus");
        }

        return redirect()->route('tour-travel.index');
    }

    public function addTravelPackage(Request $request)
    {
        $this->validate(
            $request,
            [
                'travel_id' => 'required',
                'package_name' => 'required|min:3|max:50',
                'package_price' => 'required|min:3|max:30',
                'package_description' => 'required|min:3',
                'package_active' => 'required',
            ],
            [
                'travel_id.required' => 'Mohon pilih destinasi wisata',
                'package_name.required' => 'Mohon isi nama paket',
                'package_name.min' => 'Nama paket minimal 3 karakter',
                'package_name.max' => 'Nama paket maksimal 50 karakter',
                'package_price.min' => 'Panjang karakter minimal 3 karakter',
                'package_price.max' => 'Panjang karakter maksimal 30 karakter',
                'package_active.required' => 'Mohon pilih apakah paket aktif'
            ]
        );

        $data = [
            'travel_id' => $request['travel_id'],
            'package_name' => $request['package_name'],
            'price' => $request['package_price'],
            'description' => $request['package_description'],
            'is_active' => $request['package_active'],
        ];

        $create = TravelPackage::create($data);
        if ($create) {
            Session::flash('success', "Paket wisata $request->package_name berhasil ditambahkan");
        } else {
            Session::flash('error', "Paket wisata $request->package_name gagal ditambahkan");
        }

        return redirect()->route('tour-travel.index');
    }

    public function editTravelPackage(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'edit_travel_id' => 'required',
                'edit_package_name' => 'required|min:3|max:50',
                'edit_package_price' => 'required|min:3|max:30',
                'edit_package_description' => 'required|min:3',
                'edit_package_active' => 'required',
            ],
            [
                'edit_travel_id.required' => 'Mohon pilih destinasi wisata',
                'edit_package_name.required' => 'Mohon isi nama paket',
                'edit_package_name.min' => 'Nama paket minimal 3 karakter',
                'edit_package_name.max' => 'Nama paket maksimal 50 karakter',
                'edit_package_price.min' => 'Panjang karakter minimal 3 karakter',
                'edit_package_price.max' => 'Panjang karakter maksimal 30 karakter',
                'edit_package_active.required' => 'Mohon pilih apakah paket aktif'
            ]
        );

        $travelPackage = TravelPackage::find($id);

        $data = [
            'travel_id' => $request['edit_travel_id'],
            'package_name' => $request['edit_package_name'],
            'price' => $request['edit_package_price'],
            'description' => $request['edit_package_description'],
            'is_active' => $request['edit_package_active'],
        ];

        $update = $travelPackage->update($data);
        if ($update) {
            Session::flash('success', "Paket wisata $request->edit_package_name berhasil diedit");
        } else {
            Session::flash('error', "Paket wisata $request->edit_package_name gagal diedit");
        }

        return redirect()->route('tour-travel.index');
    }

    public function deleteTravelPackage($id)
    {
        $travelPackage = TravelPackage::find($id);
        $packageName = $travelPackage['package_name'];

        $delete = $travelPackage->delete();
        if ($delete) {
            Session::flash('success', "Paket wisata $packageName berhasil dihapus");
        } else {
            Session::flash('error', "Paket wisata $packageName gagal dihapus");
        }

        return redirect()->route('tour-travel.index');
    }

    public function setActiveWisata(Request $request, $id)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'publish' => 'required',
            ],
            [
                'id.required' => 'Illegal actions',
                'publish.required' => 'Illegal actions',
            ]
        );

        if ($validate->fails()) {
            $message = $this->validation_message($validate->errors()->messages());
            return response()->json([
                'error' => $message
            ], 422);
        }

        $travel = Travel::find($id);

        if ($travel) {
            $data = [
                'is_active' => $request['publish']
            ];

            $update = $travel->update($data);

            if ($update) {
                return response()->json([
                    'message' => "Status destinasi wisata berhasil diupdate"
                ], 201);
            } else {
                return response()->json([
                    'message' => "Status destinasi wisata gagal diupdate"
                ], 422);
            }
        } else {
            return response()->json([
                'message' => "Something went wrong"
            ], 422);
        }
    }

    public function setActivePackage(Request $request, $id)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'publish' => 'required',
            ],
            [
                'id.required' => 'Illegal actions',
                'publish.required' => 'Illegal actions',
            ]
        );

        if ($validate->fails()) {
            $message = $this->validation_message($validate->errors()->messages());
            return response()->json([
                'error' => $message
            ], 422);
        }

        $travelPackage = TravelPackage::find($id);

        if ($travelPackage) {
            $data = [
                'is_active' => $request['publish']
            ];

            $update = $travelPackage->update($data);

            if ($update) {
                return response()->json([
                    'message' => "Status paket wisata berhasil diupdate"
                ], 201);
            } else {
                return response()->json([
                    'message' => "Status paket wisata gagal diupdate"
                ], 422);
            }
        } else {
            return response()->json([
                'message' => "Something went wrong"
            ], 422);
        }
    }
}
