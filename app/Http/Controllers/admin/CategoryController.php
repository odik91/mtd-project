<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
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
			$categories = Category::orderBy('category', 'asc')->get();
			return response()->json([
				'message' => ucfirst($request['kategori']) . ' berhasil ditambahkan',
				'menu' => $categories
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
		$this->validate($request, [
			'kategori-edit' => 'required|min:3|max:100|unique:categories,category,' . $id,
			'status-edit' => 'required'
		]);

		$category = Category::find($id);

		$data = [
			'category' => $request['kategori-edit'],
			'desciption' => $request['description-edit'],
			'is_active' => $request['status-edit'],
		];

		try {
			$category->update($data);
			$categories = Category::orderBy('category', 'asc')->get();
			return response()->json([
				'message' => ucwords($request['kategori-edit']) . ' berhasil diperbarui',
				'menu' => $categories
			], 201);
		} catch (Exception $error) {
			return response()->json($error, 422);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		$categoryName = $category['category'];
		try {
			$category->delete();
			Subcategory::where('category_id', $id)->update(['is_active' => 'inactive']);
			$categories = Category::orderBy('category', 'desc')->get();
			return response()->json([
				'message' => ucfirst($categoryName) . ' berhasil dihapus',
				'menu' => $categories
			], 201);
		} catch (Exception $error) {
			return response()->json($error, 422);
		}
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
				$button = '<button class="btn btn-outline-primary badge-pill" title="Edit" onclick="edit(' . $categories['id'] . ')"><i class="fas fa-edit"></i></button> <button class="btn btn-outline-danger badge-pill" title="Hapus" onclick="deleteCategory(' . $categories['id'] . ')"><i class="fas fa-trash"></i></button>';
				return $button;
			})
			->rawColumns(['status', 'actions'])
			->make(true);
	}

	public function dataTableTrashCategory()
	{
		$categories = Category::onlyTrashed()->get();
		return DataTables::of($categories)
			->addColumn('actions', function ($categories) {
				$restore = '<button class="btn btn-outline-info badge-pill" onclick="restoreCategory(' . $categories['id'] . ')">Restore</button>';
				$destroy = '<button class="btn btn-outline-danger badge-pill" onclick="destroyCategory(' . $categories['id'] . ')">Hapus Permanen</button>';
				return $restore . ' ' . $destroy;
			})
			->addIndexColumn()
			->rawColumns(['actions'])
			->make(true);
	}

	public function restoreCategory($id)
	{
		$category = Category::onlyTrashed()->where('id', $id)->first();
		try {
			Category::onlyTrashed()->where('id', $id)->restore();
			$categories = Category::orderBy('category', 'asc')->get();
			return response()->json([
				'message' => ucfirst($category['category']) . ' berhasil direstore',
				'menu' => $categories
			], 201);
		} catch (Exception $error) {
			return response()->json($error, 422);
		}
	}

	public function removeCategory($id)
	{
		$category = Category::onlyTrashed()->where('id', $id)->first();
		$categoryName = $category['category'];
		try {
			Category::onlyTrashed()->where('id', $id)->forceDelete();
			return response()->json([
				'message' => ucfirst($categoryName) . ' berhasil dihapus selamanya'
			], 201);
		} catch (Exception $error) {
			return response()->json($error, 422);
		}
	}
}
