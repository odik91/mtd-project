<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySEO;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

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
			$imageName[$key] = date('timestamp') . time() . $uniqueName . $imageFiles[$key]->getAttribute('data-filename');
			$path = public_path() . '/images/extra/' . $imageName[$key];
			file_put_contents($path, $imageData[$key]);
			$imageFile->removeAttribute('src');
			$imageFile->setAttribute('src', '/images/extra/' . $imageName[$key]);
			array_push($arrImg, $imageName[$key]);
		}

		$content = $dom->saveHTML();

		// return response()->json([
		// 	'content' => $content
		// ], 200);


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
			'country' => $request['category'],
			'region' => $request['category'],
			'thumbnail' => $thumbnail,
			'image' => $image,
			'description' => $content,
			'is_active' => $request['is_active'],
			'slug' => Str::slug($slug),
		];

		Subcategory::create($dataSubcategories);
		$findSubcategory = Subcategory::where('subcategory', $dataSubcategories['subcategory'])->first();

		$dataSubcategoriesSEO = [
			'subcategory_id' => $findSubcategory['id'],
			'meta_description' => $request['meta_description'],
			'meta_keywords' => $request['meta_keywords'],
			'seo_title' => $request['seo_title'],
		];

		CategorySEO::create($dataSubcategoriesSEO);

		return response()->json([
			'message' => 'Item ' . ucwords($request['subcategory']) . ' berhasil ditambahkan'
		], 201);
		// try {
		// } catch (Exception $error) {
		// 	// rollback ketika terjadi error
		// 	if (sizeof($arrImg) > 0) {
		// 		for ($i = 0; $i < sizeof($arrImg); $i++) {
		// 			if (file_exists(public_path("images/extra/{$arrImg[$i]}"))) {
		// 				unlink(public_path("images/extra/{$arrImg[$i]}"));
		// 			}
		// 		}
		// 	}

		// 	Subcategory::where('subcategory', 'like', '%' . ucwords($request['subcategory']) . '%')->forceDelete();

		// 	return response()->json($error, 422);
		// }
	}
}
