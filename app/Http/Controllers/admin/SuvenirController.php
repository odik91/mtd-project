<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Suvenir;
use App\Models\SuvenirCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SuvenirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Oleh-oleh';
        $suvenirs = SuvenirCategory::orderBy('name', 'asc')->get();
        $listSuvenirs = Suvenir::get();
        return view('admin.suvenir.index', compact('title', 'suvenirs', 'listSuvenirs'));
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
                'name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Mohon masukkan nama kategori oleh-oleh',
                'name.min' => 'Minimal 3 karakter',
                'name.max' => 'Maksimal 50 karakter',
            ]
        );

        $data = ['name' => $request['name']];

        $create = SuvenirCategory::create($data);

        if ($create) {
            Session::flash('success', "Kategori $request->name berhasil ditambahkan");
        } else {
            Session::flash('error', "Kategori $request->name gagal ditambahkan");
        }

        return redirect()->route('oleh-oleh.index');
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
                'edit_name' => 'required|min:3|max:50',
            ],
            [
                'edit_name.required' => 'Mohon masukkan nama kategori oleh-oleh',
                'edit_name.min' => 'Minimal 3 karakter',
                'edit_name.max' => 'Maksimal 50 karakter',
            ]
        );

        $catSuvenir = SuvenirCategory::find($id);
        $data = ['name' => $request['edit_name']];

        $update = $catSuvenir->update($data);

        if ($update) {
            Session::flash('success', "Kategori $request->edit_name berhasil diedit");
        } else {
            Session::flash('error', "Kategori $request->edit_name gagal diedit");
        }

        return redirect()->route('oleh-oleh.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catSuvenir = SuvenirCategory::find($id);
        $catName = $catSuvenir['name'];

        $delete = $catSuvenir->delete();

        if ($delete) {
            Session::flash('success', "Kategori $catName berhasil dihapus");
        } else {
            Session::flash('error', "Kategori $catName gagal dihapus");
        }

        return redirect()->route('oleh-oleh.index');
    }

    // private method untuk resize image
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

    public function addSuvenirItem(Request $request)
    {
        $this->validate(
            $request,
            [
                'suvenir_name' => 'required|min:3|max:50',
                'first_text' => 'required|min:3|max:50',
                'start_price' => 'required|min:3|max:50',
                'suvenir_category_id' => 'required',
                'suvenir_description' => 'required|min:3',
                'suvenir_active' => 'required',
                'thumbnail' => 'required|mimes:jpg,bmp,png',
                'image' => 'required|mimes:jpg,bmp,png',
            ],
            [
                'suvenir_name.required' => 'Mohon masukkan nama oleh-oleh',
                'suvenir_name.min' => 'Nama oleh-oleh minimal 3 karakter',
                'suvenir_name.max' => 'Nama oleh-oleh maksimal 50 karakter',
                'first_text.required' => 'Mohon masukkan middle text',
                'first_text.min' => 'Middle text minimal 3 karakter',
                'first_text.max' => 'Middle text maksimal 50 karakter',
                'start_price.required' => 'Mohon masukkan bottom text',
                'start_price.min' => 'Bottom text minimal 3 karakter',
                'start_price.max' => 'Bottom text maksimal 50 karakter',
                'suvenir_category_id.required' => 'Pilih salah satu kategori oleh-oleh',
                'suvenir_description.required' => 'Mohon masukkan deskripsi',
                'suvenir_description.min' => 'Deskripsi minimal 3 karakter',
                'suvenir_description.min' => 'Deskripsi minimal 3 karakter',
                'suvenir_active.required' => 'Mohon pilh salah satu pilihan aktif'
            ]
        );

        $thumbnail = null;
        $image = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->_resizeImage($request['thumbnail'], 1280, 1280, '/images/suvenirs');
        }

        if ($request->hasFile('image')) {
            $image = $this->_resizeImage($request['image'], 1280, 1280, '/images/suvenirs');
        }

        $data = [
            'suvenir_name' => $request['suvenir_name'],
            'suvenir_category_id' => $request['suvenir_category_id'],
            'first_text' => $request['first_text'],
            'start_price' => $request['start_price'],
            'thumbnail' => $thumbnail,
            'image' => $image,
            'description' => $request['suvenir_description'],
            'is_active' => $request['suvenir_active'],
            'slug' => Str::slug($request['suvenir_name'])
        ];

        $create = Suvenir::create($data);

        if ($create) {
            Session::flash('success', "Oleh-oleh $request->suvenir_name berhasil ditambahkan");
        } else {
            Session::flash('error', "Oleh-oleh $request->suvenir_name gagal ditambahkan");
        }

        return redirect()->route('oleh-oleh.index');
    }

    public function editSuvenirItem(Request $request, $id) {
        $this->validate(
            $request,
            [
                'edit_suvenir_name' => 'required|min:3|max:50',
                'edit_first_text' => 'required|min:3|max:50',
                'edit_start_price' => 'required|min:3|max:50',
                'edit_suvenir_category_id' => 'required',
                'edit_suvenir_description' => 'required|min:3',
                'edit_suvenir_active' => 'required',
                'edit_thumbnail' => 'mimes:jpg,bmp,png',
                'edit_image' => 'mimes:jpg,bmp,png',
            ],
            [
                'edit_suvenir_name.required' => 'Mohon masukkan nama oleh-oleh',
                'edit_suvenir_name.min' => 'Nama oleh-oleh minimal 3 karakter',
                'edit_suvenir_name.max' => 'Nama oleh-oleh maksimal 50 karakter',
                'edit_first_text.required' => 'Mohon masukkan middle text',
                'edit_first_text.min' => 'Middle text minimal 3 karakter',
                'edit_first_text.max' => 'Middle text maksimal 50 karakter',
                'edit_start_price.required' => 'Mohon masukkan bottom text',
                'edit_start_price.min' => 'Bottom text minimal 3 karakter',
                'edit_start_price.max' => 'Bottom text maksimal 50 karakter',
                'edit_suvenir_category_id.required' => 'Pilih salah satu kategori oleh-oleh',
                'edit_suvenir_description.required' => 'Mohon masukkan deskripsi',
                'edit_suvenir_description.min' => 'Deskripsi minimal 3 karakter',
                'edit_suvenir_description.min' => 'Deskripsi minimal 3 karakter',
                'edit_suvenir_active.required' => 'Mohon pilh salah satu pilihan aktif'
            ]
        );

        $item = Suvenir::find($id);

        $thumbnail = $item['thumbnail'];
        $image = $item['image'];

        if ($request->hasFile('edit_thumbnail')) {
            if (file_exists(public_path('/images/suvenirs/' . $thumbnail))) {
                unlink(public_path('/images/suvenirs/' . $thumbnail));
            }
            $thumbnail = $this->_resizeImage($request['edit_thumbnail'], 1280, 1280, '/images/suvenirs');
        }

        if ($request->hasFile('edit_image')) {
            if (file_exists(public_path('/images/suvenirs/' . $thumbnail))) {
                unlink(public_path('/images/suvenirs/' . $thumbnail));
            }
            $image = $this->_resizeImage($request['edit_image'], 1280, 1280, '/images/suvenirs');
        }

        $data = [
            'suvenir_name' => $request['edit_suvenir_name'],
            'suvenir_category_id' => $request['edit_suvenir_category_id'],
            'first_text' => $request['edit_first_text'],
            'start_price' => $request['edit_start_price'],
            'thumbnail' => $thumbnail,
            'image' => $image,
            'description' => $request['edit_suvenir_description'],
            'is_active' => $request['edit_suvenir_active'],
            'slug' => Str::slug($request['edit_suvenir_name'])
        ];

        $update = $item->update($data);

        if ($update) {
            Session::flash('success', "Oleh-oleh $request->edit_suvenir_name berhasil diedit");
        } else {
            Session::flash('error', "Oleh-oleh $request->edit_suvenir_name gagal diedit");
        }

        return redirect()->route('oleh-oleh.index');
    }

    public function deleteSuvenirItem($id) {
        $suvenir = Suvenir::find($id);
        $name = $suvenir['suvenir_name'];

        $delete = $suvenir->delete();

        if ($delete) {
            Session::flash('success', "Oleh-oleh $name berhasil dihapus");
        } else {
            Session::flash('error', "Oleh-oleh $name gagal dihapus");
        }

        return redirect()->route('oleh-oleh.index');
    }

    public function setActivePackage(Request $request, $id) {

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

        $suvenir = Suvenir::find($id);

        if ($suvenir) {
            $data = [
                'is_active' => $request['publish']
            ];

            $update = $suvenir->update($data);

            if ($update) {
                return response()->json([
                    'message' => "Status oleh-oleh berhasil diupdate"
                ], 201);
            } else {
                return response()->json([
                    'message' => "Status oleh-oleh gagal diupdate"
                ], 422);
            }
        } else {
            return response()->json([
                'message' => "Something went wrong"
            ], 422);
        }
    }
}
