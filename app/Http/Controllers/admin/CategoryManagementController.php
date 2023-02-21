<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySEO;
use App\Models\Subcategory;
use App\Models\SubcategoryPackage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryManagementController extends Controller
{
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

	public function mainPageCategory($id)
	{
		$category = Category::find($id);
		$title = ucwords($category['category']);

		return view('admin.extra-page.index', compact('category', 'title'));
	}

	public function ajaxStoreItem(Request $request)
	{
		$this->validate(
			$request,
			[
				'category' => 'required',
				'subcategory' => 'required|min:3|max:30|unique:subcategories',
				'first_text' => 'required|min:3|max:30',
				'second_text' => 'required|min:3|max:30',
				'second_text' => 'required|min:3|max:30',
				'country' => 'required|min:3|max:255',
				'region' => 'required|min:3|max:255',
				'thumbnail' => 'required|mimes:jpg,bmp,png|max:2048',
				'image' => 'required|mimes:jpg,bmp,png|max:2048',
				'meta_description' => 'required|min:3|max:255',
				'meta_keywords' => 'required|min:3|max:255',
				'seo_title' => 'required|min:3|max:255',
				'is_active' => 'required',
				'item_description' => 'required',
			],
			[
				'category.required' => 'Unauthorized',

				'subcategory.required' => 'Mohon isi judul',
				'subcategory.min' => 'Judul minimal 3 karakter',
				'subcategory.max' => 'Judul maksimal 30 karakter',
				'subcategory.unique' => 'Judul telah ada',

				'first_text.required' => 'Mohon isi kalimat pendukung',
				'first_text.min' => 'Kalimat pendukung minimal 3 karakter',
				'first_text.max' => 'Kalimat pendukung maksimal 30 karakter',

				'second_text.required' => 'Mohon isi harga',
				'second_text.min' => 'Harga minimal 3 karakter',
				'second_text.max' => 'Harga maksimal 30 karakter',

				'country.required' => 'Mohon isi negara',
				'country.min' => 'Negara minimal 3 karakter',
				'country.max' => 'Negara maksimal 255 karakter',

				'region.required' => 'Mohon isi daerah',
				'region.min' => 'Daerah minimal 3 karakter',
				'region.max' => 'Daerah maksimal 255 karakter',

				'thumbnail.required' => 'Mohon isi thubmnail',
				'thumbnail.mimes' => 'File yang diperbolehkan hanya gambar',
				'thumbnail.max' => 'Maksimal file 2mb',

				'image.required' => 'Mohon isi gambar',
				'image.mimes' => 'File yang diperbolehkan hanya gambar',
				'image.max' => 'Maksimal file 2mb',

				'meta_description.required' => 'Mohon isi meta description',
				'meta_description.min' => 'Meta description minimal 3 karakter',
				'meta_description.max' => 'Meta description maksimal 255 karakter',

				'meta_keywords.required' => 'Mohon isi meta keywords',
				'meta_keywords.min' => 'Meta keywords minimal 3 karakter',
				'meta_keywords.max' => 'Meta keywords maksimal 255 karakter',

				'seo_title.required' => 'Mohon isi SEO title',
				'seo_title.min' => 'SEO title minimal 3 karakter',
				'seo_title.max' => 'SEO title maksimal 255 karakter',

				'is_active.required' => 'Mohon pilih status',

				'item_description.required' => 'Mohon isi deskripsi',
			]
		);

		$content = $request['item_description'];

		// dd($request->all());

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
			$imageName[$key] = date('timestamp') . time() . $uniqueName . $imageFiles[$key]->getAttribute('data-filename') . '.' . explode('/', $type)[1];

			$path = public_path() . '/images/extra/' . $imageName[$key];
			file_put_contents($path, $imageData[$key]);
			$imageFile->removeAttribute('src');
			$imageFile->setAttribute('src', '/images/extra/' . $imageName[$key]);
			array_push($arrImg, $imageName[$key]);
		}

		$content = $dom->saveHTML();

		$thumbnail = null;
		$image = null;

		if ($request->hasFile('thumbnail')) {
			$thumbnail = $this->_resizeImage($request['thumbnail'], 364, 364, '/images/extra');
		}

		if ($request->hasFile('image')) {
			$image = $this->_resizeImage($request['image'], 1280, 1280, '/images/extra');
		}

		$slug = 'mame tirta dewata wisata ' . $request['subcategory'];

		$dataSubcategories = [
			'subcategory' => ucwords($request['subcategory']),
			'category_id' => $request['category'],
			'first_text' => $request['first_text'],
			'second_text' => $request['second_text'],
			'country' => $request['country'],
			'region' => $request['region'],
			'thumbnail' => $thumbnail,
			'image' => $image,
			'description' => $content,
			'is_active' => $request['is_active'],
			'slug' => Str::slug($slug),
		];


		try {
			Subcategory::create($dataSubcategories);
			$findSubcategory = Subcategory::where('subcategory', $dataSubcategories['subcategory'])->first();

			$dataSubcategoriesSEO = [
				'subcategory_id' => $findSubcategory['id'],
				'meta_description' => $request['meta_description'],
				'meta_keywords' => $request['meta_keywords'],
				'seo_title' => $request['seo_title'],
			];

			CategorySEO::create($dataSubcategoriesSEO);
			Session::flash('success', ucwords($request['subcategory']) .  " berhasil ditambahkan");
			return redirect()->back();

			// return response()->json([
			// 	'message' => 'Item ' . ucwords($request['subcategory']) . ' berhasil ditambahkan'
			// ], 201);
		} catch (Exception $error) {
			// rollback ketika terjadi error
			if (sizeof($arrImg) > 0) {
				for ($i = 0; $i < sizeof($arrImg); $i++) {
					if (file_exists(public_path("images/extra/{$arrImg[$i]}"))) {
						unlink(public_path("images/extra/{$arrImg[$i]}"));
					}
				}
			}

			Subcategory::where('subcategory', 'like', '%' . ucwords($request['subcategory']) . '%')->forceDelete();

			Session::flash('error', ucwords($request['subcategory']) .  " gagal ditambahkan");
			return redirect()->back();

			// return response()->json($error, 422);
		}
	}

	public function editItem($id)
	{
		$subcategory = Subcategory::find($id);
		$title = 'Edit ' . ucwords($subcategory['subcategory']);
		$seo = CategorySEO::where('subcategory_id', $id)->first();
		return view('admin.extra-page.edit-item', compact('title', 'subcategory', 'seo'));
	}

	public function updateItem(Request $request, $id)
	{
		$this->validate(
			$request,
			[
				'subcategory' => 'required|min:3|max:30|unique:subcategories,subcategory,' . $id . ',id',
				'first_text' => 'required|min:3|max:30',
				'second_text' => 'required|min:3|max:30',
				'second_text' => 'required|min:3|max:30',
				'country' => 'required|min:3|max:255',
				'region' => 'required|min:3|max:255',
				'thumbnail' => 'mimes:jpg,bmp,png|max:2048',
				'image' => 'mimes:jpg,bmp,png|max:2048',
				'meta_description' => 'required|min:3|max:255',
				'meta_keywords' => 'required|min:3|max:255',
				'seo_title' => 'required|min:3|max:255',
				'is_active' => 'required',
				'item_description' => 'required',
			],
			[
				'category.required' => 'Unauthorized',

				'subcategory.required' => 'Mohon isi judul',
				'subcategory.min' => 'Judul minimal 3 karakter',
				'subcategory.max' => 'Judul maksimal 30 karakter',
				'subcategory.unique' => 'Judul telah ada',

				'first_text.required' => 'Mohon isi kalimat pendukung',
				'first_text.min' => 'Kalimat pendukung minimal 3 karakter',
				'first_text.max' => 'Kalimat pendukung maksimal 30 karakter',

				'second_text.required' => 'Mohon isi harga',
				'second_text.min' => 'Harga minimal 3 karakter',
				'second_text.max' => 'Harga maksimal 30 karakter',

				'country.required' => 'Mohon isi negara',
				'country.min' => 'Negara minimal 3 karakter',
				'country.max' => 'Negara maksimal 255 karakter',

				'region.required' => 'Mohon isi daerah',
				'region.min' => 'Daerah minimal 3 karakter',
				'region.max' => 'Daerah maksimal 255 karakter',

				'thumbnail.mimes' => 'File yang diperbolehkan hanya gambar',
				'thumbnail.max' => 'Maksimal file 2mb',

				'image.mimes' => 'File yang diperbolehkan hanya gambar',
				'image.max' => 'Maksimal file 2mb',

				'meta_description.required' => 'Mohon isi meta description',
				'meta_description.min' => 'Meta description minimal 3 karakter',
				'meta_description.max' => 'Meta description maksimal 255 karakter',

				'meta_keywords.required' => 'Mohon isi meta keywords',
				'meta_keywords.min' => 'Meta keywords minimal 3 karakter',
				'meta_keywords.max' => 'Meta keywords maksimal 255 karakter',

				'seo_title.required' => 'Mohon isi SEO title',
				'seo_title.min' => 'SEO title minimal 3 karakter',
				'seo_title.max' => 'SEO title maksimal 255 karakter',

				'is_active.required' => 'Mohon pilih status',

				'item_description.required' => 'Mohon isi deskripsi',
			]
		);

		$subcategory = Subcategory::find($id);
		$thumbnail = $subcategory['thumbnail'];
		$image = $subcategory['image'];

		$oldContent = $subcategory['description'];

		// mendapatkan nilai gambar yang digunakan pada content lama
		$domOldArticle = new \DOMDocument();
		$domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | libxml_use_internal_errors(true));
		$findImages = $domOldArticle->getElementsByTagName('img');
		$oldImages = [];

		foreach ($findImages as $key => $findImage) {
			$data = $findImage->getAttribute('src');
			$data = explode('/', $data);
			array_push($oldImages, $data[3]);
		}

		$content = $request['item_description'];
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
			$imageName[$key] = date('timestamp') . time() . $key . $uniqueName . $imageFiles[$key]->getAttribute('data-filename') . '.' . explode('/', $type)[1];
			$path = public_path() . "/images/extra/" . $imageName[$key];
			file_put_contents($path, $imageData[$key]);
			$imageFile->removeAttribute('src');
			$imageFile->setAttribute('src', '/images/extra/' . $imageName[$key]);
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

		if ($request->hasFile('thumbnail')) {
			if (file_exists(public_path('images/extra/' . $thumbnail))) {
				unlink(public_path('images/extra/' . $thumbnail));
			}
			$thumbnail = $this->_resizeImage($request['thumbnail'], 364, 364, '/images/extra');
		}

		if ($request->hasFile('image')) {
			if (file_exists(public_path('images/extra/' . $image))) {
				unlink(public_path('images/extra/' . $image));
			}
			$image = $this->_resizeImage($request['image'], 1280, 1280, '/images/extra');
		}

		$dataSubcategories = [
			'subcategory' => ucwords($request['subcategory']),
			'first_text' => $request['first_text'],
			'second_text' => $request['second_text'],
			'country' => $request['country'],
			'region' => $request['region'],
			'thumbnail' => $thumbnail,
			'image' => $image,
			'description' => $content,
			'is_active' => $request['is_active'],
		];

		try {
			$update = $subcategory->update($dataSubcategories);

			$dataSubcategoriesSEO = [
				'meta_description' => $request['meta_description'],
				'meta_keywords' => $request['meta_keywords'],
				'seo_title' => $request['seo_title'],
			];

			CategorySEO::where('subcategory_id', $id)->update($dataSubcategoriesSEO);

			if ($update) {
				$arrayRemoveimage = array_diff($oldImages, $newArrayImages);
				$arrayRemoveimage = implode("/", $arrayRemoveimage);
				$arrayRemoveimage = explode("/", $arrayRemoveimage);
				if (sizeof($arrayRemoveimage) > 0) {
					for ($i = 0; $i < sizeof($arrayRemoveimage); $i++) {
						if ($arrayRemoveimage[$i] != "") {
							if (file_exists(public_path("images/extra/{$arrayRemoveimage[$i]}"))) {
								unlink(public_path("images/extra/{$arrayRemoveimage[$i]}"));
							}
						}
					}
				}
				Session::flash('success', "Item berhasil diedit");
			} else {
				Session::flash('error', "Item gagal diedit");
			}
			return redirect()->route('extra-pages.main', $subcategory['category_id']);
		} catch (Exception $error) {
			Session::flash('error', "Item gagal diedit");
			return redirect()->route('extra-pages.main', $subcategory['category_id']);
		}
	}

	public function dataTableItem($id)
	{
		if (request()->ajax()) {
			$subcategories = Subcategory::where('category_id', $id)->orderBy('subcategory', 'asc')->get();

			return DataTables::of($subcategories)
				->addIndexColumn()
				->addColumn('status', function ($subcategories) {
					$pill = '';
					if ($subcategories['is_active'] == 'active') {
						$pill = '<span class="btn btn-sm btn-outline-success badge-pill px-2 py-1">Aktif</span>';
					} else {
						$pill = '<span class="btn btn-sm btn-outline-danger badge-pill px-2 py-1">Tidak</span>';
					}
					return $pill;
				})
				->addColumn('aksi', function ($subcategories) {
					$edit = '<a href="' . route('extra-pages.edit-item', $subcategories['id']) . '" class="btn btn-outline-primary badge-pill" title="Edit"><i class="fas fa-edit"></i></a>';
					$delete = '<button class="btn btn-outline-danger badge-pill" title="Hapus" onclick="deleteItem(' . $subcategories['id'] . ')"><i class="fas fa-trash"></i></button>';

					return $edit . ' ' . $delete;
				})
				->rawColumns(['status', 'aksi'])
				->make(true);
		}
	}

	public function ajaxDeleteItem($id)
	{
		$subcategory = Subcategory::find($id);
		$name = $subcategory['subcategory'];

		try {
			$subcategory->delete();
			return response()->json([
				'message' => ucwords($name) . ' berhasil dihapus'
			], 200);
		} catch (Exception $e) {
			return response()->json([
				'message' => ucwords($name) . ' gagal dihapus'
			], 422);
		}
	}

	public function ajaxRestoreItem($id)
	{
		try {
			Subcategory::onlyTrashed()->where('id', $id)->restore();
			return response()->json([
				'message' => ucwords(Subcategory::find($id)['subcategory']) . ' berhasil dipulihkan'
			], 200);
		} catch (Exception $e) {
			return response()->json([
				'message' => 'Gagal memulihkan item'
			], 422);
		}
	}

	public function ajaxDestroyItem($id)
	{
		try {
			$subcategory = Subcategory::onlyTrashed()->where('id', $id)->first();
			$name = $subcategory['subcategory'];
			$oldContent = $subcategory['description'];

			// mendapatkan nilai gambar yang digunakan pada content lama
			$domOldArticle = new \DOMDocument();
			$domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | libxml_use_internal_errors(true));
			$findImages = $domOldArticle->getElementsByTagName('img');
			$oldImages = [];

			foreach ($findImages as $key => $findImage) {
				$data = $findImage->getAttribute('src');
				$data = explode('/', $data);
				array_push($oldImages, $data[3]);
			}

			if (sizeof($oldImages) > 0) {
				for ($i = 0; $i < sizeof($oldImages); $i++) {
					if ($oldImages[$i] != "") {
						if (file_exists(public_path("images/extra/{$oldImages[$i]}"))) {
							unlink(public_path("images/extra/{$oldImages[$i]}"));
						}
					}
				}
			}

			Subcategory::onlyTrashed()->where('id', $id)->forceDelete();

			return response()->json([
				'message' => ucfirst($name) . ' berhasil dimusnahkan'
			], 200);
		} catch (Exception $e) {
			return response()->json([
				'message' => 'Gagal memusnahkan item'
			], 422);
		}
	}

	public function dataTableTrashItem($id)
	{
		if (request()->ajax()) {
			$subcategories = Subcategory::onlyTrashed()->where('category_id', $id)->orderBy('subcategory')->get();

			return DataTables::of($subcategories)
				->addIndexColumn()
				->addColumn('actions', function ($subcategories) {
					$restore = '<button class="btn btn-outline-warning badge-pill" onclick=restoreItem(' . $subcategories['id'] . ') title="Pulihkan"><i class="fas fa-trash-restore-alt"></i></button>';

					$destroy = '<button class="btn btn-outline-danger badge-pill" title="Musnahkan" onclick="removeItem(' . $subcategories['id'] . ')"><i class="fas fa-eraser"></i></button>';

					return $restore . ' ' . $destroy;
				})
				->rawColumns(['actions'])
				->make(true);
		}
	}

	public function storeSubitems(Request $request)
	{
		$this->validate($request, [
			'item_id' => 'required',
			'package_name' => 'required|unique:subcategory_packages,package_name',
			'price_subitem' => 'required',
			'image_subitem' => 'required|mimes:jpg,bmp,png|max:2048',
			'is_active_subitem' => 'required',
			'subitem_description' => 'required',
		]);

		$content = $request['subitem_description'];

		// dd($request->all());

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
			$imageName[$key] = date('timestamp') . time() . $uniqueName . $imageFiles[$key]->getAttribute('data-filename') . '.' . explode('/', $type)[1];

			$path = public_path() . '/images/extra/' . $imageName[$key];
			file_put_contents($path, $imageData[$key]);
			$imageFile->removeAttribute('src');
			$imageFile->setAttribute('src', '/images/extra/' . $imageName[$key]);
			array_push($arrImg, $imageName[$key]);
		}

		$content = $dom->saveHTML();

		$thumbnail = null;

		if ($request->hasFile('image_subitem')) {
			$thumbnail = $this->_resizeImage($request['image_subitem'], 364, 364, '/images/extra');
		}

		$data = [
			'subcategory_id' => $request['item_id'],
			'package_name' => ucwords($request['package_name']),
			'price' => $request['price_subitem'],
			'thumbnail' => $thumbnail,
			'description' => $content,
			'is_active' => $request['is_active_subitem'],
		];


		try {
			SubcategoryPackage::create($data);

			Session::flash('success', ucwords($request['subcategory']) .  " berhasil ditambahkan");

			return redirect()->back();
		} catch (Exception $error) {
			// rollback ketika terjadi error
			if (sizeof($arrImg) > 0) {
				for ($i = 0; $i < sizeof($arrImg); $i++) {
					if (file_exists(public_path("images/extra/{$arrImg[$i]}"))) {
						unlink(public_path("images/extra/{$arrImg[$i]}"));
					}
				}
			}

			SubcategoryPackage::where('package_name', 'like', '%' . ucwords($request['package_name']) . '%')->forceDelete();

			Session::flash('error', ucwords($request['subcategory']) .  " gagal ditambahkan");
			return redirect()->back();
		}
	}

	public function dataTableSubitem($subcat)
	{
		if (request()->ajax()) {
			$listSubcategory = [];
			$subcategories = Subcategory::where('category_id', $subcat)->get();
			foreach ($subcategories as $subcategory) {
				array_push($listSubcategory, $subcategory['id']);
			}

			$packages = SubcategoryPackage::whereIn('subcategory_id', $listSubcategory)->orderBy('package_name', 'asc')->get();

			return DataTables::of($packages)
				->addIndexColumn()
				->addColumn('subname', function ($packages) {
					return $packages->getSubcategory['subcategory'];
				})
				->addColumn('status', function ($packages) {
					$pill = '';
					if ($packages['is_active'] == 'active') {
						$pill = '<span class="btn btn-sm btn-outline-success badge-pill px-2 py-1">Aktif</span>';
					} else {
						$pill = '<span class="btn btn-sm btn-outline-danger badge-pill px-2 py-1">Tidak</span>';
					}
					return $pill;
				})
				->addColumn('image', function ($packages) {
					return '<img src="' . asset('images/extra/' . $packages['thumbnail']) . '" width="75px">';
				})
				->addColumn('aksi', function ($packages) {
					$edit = '<a href="' . route('extra-pages.subitem.edit', $packages['id']) . '" class="btn btn-outline-primary badge-pill" title="Edit"><i class="fas fa-edit"></i></a>';
					$delete = '<button class="btn btn-outline-danger badge-pill" title="Hapus" onclick="deletePackage(' . $packages['id'] . ')"><i class="fas fa-trash"></i></button>';

					return $edit . ' ' . $delete;
				})
				->rawColumns(['subname', 'status', 'image', 'aksi'])
				->make(true);
		}
	}

	public function editPackage($id)
	{
		$package = SubcategoryPackage::find($id);
		$title = 'Edit ' . ucwords($package['package_name']);
		return view('admin.extra-page.edit-package', compact('package', 'title'));
	}

	public function updatePackage(Request $request, $id)
	{
		$this->validate($request, [
			'item_id' => 'required',
			'package_name' => 'required|unique:subcategory_packages,id,' . $id,
			'price_subitem' => 'required',
			'image_subitem' => 'mimes:jpg,bmp,png|max:2048',
			'is_active_subitem' => 'required',
			'subitem_description' => 'required',
		]);

		$content = $request['subitem_description'];

		// dd($request->all());

		$package = SubcategoryPackage::find($id);
		$thumbnail = $package['thumbnail'];

		$oldContent = $package['description'];

		// mendapatkan nilai gambar yang digunakan pada content lama
		$domOldArticle = new \DOMDocument();
		$domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | libxml_use_internal_errors(true));
		$findImages = $domOldArticle->getElementsByTagName('img');
		$oldImages = [];

		foreach ($findImages as $key => $findImage) {
			$data = $findImage->getAttribute('src');
			$data = explode('/', $data);
			array_push($oldImages, $data[3]);
		}

		$content = $request['subitem_description'];
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
			$imageName[$key] = date('timestamp') . time() . $key . $uniqueName . $imageFiles[$key]->getAttribute('data-filename') . '.' . explode('/', $type)[1];
			$path = public_path() . "/images/extra/" . $imageName[$key];
			file_put_contents($path, $imageData[$key]);
			$imageFile->removeAttribute('src');
			$imageFile->setAttribute('src', '/images/extra/' . $imageName[$key]);
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

		if ($request->hasFile('image_subitem')) {
			if (file_exists(public_path('images/extra/' . $thumbnail))) {
				unlink(public_path('images/extra/' . $thumbnail));
			}
			$thumbnail = $this->_resizeImage($request['image_subitem'], 364, 364, '/images/extra');
		}

		$data = [
			'subcategory_id' => $request['item_id'],
			'package_name' => ucwords($request['package_name']),
			'price' => $request['price_subitem'],
			'thumbnail' => $thumbnail,
			'description' => $content,
			'is_active' => $request['is_active_subitem'],
		];

		try {
			$update = $package->update($data);

			if ($update) {
				$arrayRemoveimage = array_diff($oldImages, $newArrayImages);
				$arrayRemoveimage = implode("/", $arrayRemoveimage);
				$arrayRemoveimage = explode("/", $arrayRemoveimage);
				if (sizeof($arrayRemoveimage) > 0) {
					for ($i = 0; $i < sizeof($arrayRemoveimage); $i++) {
						if ($arrayRemoveimage[$i] != "") {
							if (file_exists(public_path("images/extra/{$arrayRemoveimage[$i]}"))) {
								unlink(public_path("images/extra/{$arrayRemoveimage[$i]}"));
							}
						}
					}
				}
				Session::flash('success', "Item berhasil diedit");
			} else {
				Session::flash('error', "Item gagal diedit");
			}
			return redirect()->route('extra-pages.main', $package->getSubcategory['category_id']);
		} catch (Exception $error) {
			Session::flash('error', "Item gagal diedit");
			return redirect()->route('extra-pages.main', $package->getSubcategory['category_id']);
		}
	}

	public function deletePackage($id)
	{
		try {
			$package = SubcategoryPackage::find($id);
			$name = $package['package_name'];
			$package->delete();
			return response()->json([
				'message' => 'Paket ' . $name . ' berhasil dihapus'
			], 200);
		} catch (Exception $e) {
			return response()->json($e, 422);
		}
	}

	public function dataTableTrashSubitem($subcat)
	{
		$listSubcategory = [];
		$subcategories = Subcategory::where('category_id', $subcat)->get();
		foreach ($subcategories as $subcategory) {
			array_push($listSubcategory, $subcategory['id']);
		}

		$packages = SubcategoryPackage::join('subcategories', 'subcategory_packages.subcategory_id', 'subcategories.id')
			->onlyTrashed()
			->select('subcategory_packages.*', 'subcategories.subcategory', 'subcategories.category_id')
			->whereIn('subcategory_packages.subcategory_id', $listSubcategory)
			->orderBy('subcategory_packages.package_name', 'asc')->get();

		return DataTables::of($packages)
			->addIndexColumn()
			->addColumn('subname', function ($packages) {
				return $packages->getSubcategory['subcategory'];
			})
			->addColumn('status', function ($packages) {
				$pill = '';
				if ($packages['is_active'] == 'active') {
					$pill = '<span class="btn btn-sm btn-outline-success badge-pill px-2 py-1">Aktif</span>';
				} else {
					$pill = '<span class="btn btn-sm btn-outline-danger badge-pill px-2 py-1">Tidak</span>';
				}
				return $pill;
			})
			->addColumn('image', function ($packages) {
				return '<img src="' . asset('images/extra/' . $packages['thumbnail']) . '" width="75px">';
			})
			->addColumn('aksi', function ($packages) {
				$restore = '<button onclick="restorePackage(' . $packages['id'] . ')" class="btn btn-outline-warning badge-pill" title="Pulihkan"><i class="fas fa-trash-restore-alt"></i></button>';

				$destroy = '<button class="btn btn-outline-danger badge-pill" title="Musnahkan" onclick="destroyPackage(' . $packages['id'] . ')"><i class="fas fa-eraser"></i></button>';

				return $restore . ' ' . $destroy;
			})
			->rawColumns(['subname', 'status', 'image', 'aksi'])
			->make(true);
	}

	public function restoreSubitem($id)
	{
		try {
			$package = SubcategoryPackage::onlyTrashed()->where('id', $id)->first();
			SubcategoryPackage::onlyTrashed()->where('id', $id)->restore();
			return response()->json([
				'message' => 'Paket ' . ucwords($package['package_name']) . ' berhasil dipulihkan'
			]);
		} catch (Exception $e) {
			return response()->json($e, 422);
		}
	}

	public function destroySubitem($id)
	{
		try {
			$package = SubcategoryPackage::onlyTrashed()->where('id', $id)->first();

			$oldContent = $package['description'];

			// mendapatkan nilai gambar yang digunakan pada content lama
			$domOldArticle = new \DOMDocument();
			$domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | libxml_use_internal_errors(true));
			$findImages = $domOldArticle->getElementsByTagName('img');
			$oldImages = [];

			foreach ($findImages as $key => $findImage) {
				$data = $findImage->getAttribute('src');
				$data = explode('/', $data);
				array_push($oldImages, $data[3]);
			}

			SubcategoryPackage::onlyTrashed()->where('id', $id)->forceDelete();

			if (sizeof($oldImages) > 0) {
				for ($i = 0; $i < sizeof($oldImages); $i++) {
					if (file_exists(public_path("images/extra/{$oldImages[$i]}"))) {
						unlink(public_path("images/extra/{$oldImages[$i]}"));
					}
				}
			}
			
			return response()->json([
				'message' => 'Paket ' . ucwords($package['package_name']) . ' berhasil dimusnahkan'
			]);
		} catch (Exception $e) {
			return response()->json($e, 422);
		}
	}
}
