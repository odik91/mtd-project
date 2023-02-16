<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori';
        return view('admin.category.index', compact('title'));
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
        $this->validate($request, [
            'kategori' => 'required|unique:categories,category',
            'status' => 'required',
        ]);

        $data = [
            'category' => $request['kategori'],
            'desciption' => $request['description'],
            'is_active' => $request['status'],
        ];

        try {
            Category::create($data);
            return response()->json([
                'message' => ucfirst($request['kategori']) . ' berhasil ditambahkan'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                $error
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
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

    public function dataTableCategory()
    {
        $categories = Category::orderBy('category', 'asc')->get();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('status', function ($categories) {
                $status = null;
                if ($categories['is_active'] == 'active') {
                    $status = '<span class="badge badge-pill badge-success px-4 py-2">Aktif</span>';
                } else {
                    $status = '<span class="badge badge-pill badge-warning px-4 py-2">Tidak aktif</span>';
                }
                return $status;
            })
            ->addColumn('actions', function ($categories) {
                $button = '<button class="btn btn-outline-primary badge-pill" title="Edit" onclick="edit(' . $categories['id'] . ')"><i class="fas fa-edit"></i></button> <button class="btn btn-outline-danger badge-pill" title="Hapus" onclick="delete(' . $categories['id'] . ')"><i class="fas fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
}
