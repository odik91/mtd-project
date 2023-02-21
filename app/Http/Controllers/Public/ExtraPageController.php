<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySEO;
use App\Models\Subcategory;
use App\Models\SubcategoryPackage;
use Illuminate\Http\Request;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;

class ExtraPageController extends Controller
{
    public function getExtraPage($id, $slug) {
        $subcategories = Subcategory::where('category_id', $id)->where('is_active', 'active')->get();
        $category = Category::find($id);
        $title = 'MTD | ' . ucwords($category['category']);

        $keywords = [$title, "mtd tour and travel batam $category->category", $category->category];

        SEOTools::setTitle($title, false);
        SEOTools::setDescription("mame tirta dewata tour and travel batam $category->category", false);
        SEOTools::opengraph()->setUrl(route('public-extra.index', [$category['id'], str_replace(' ', '-', $category['category'])]));
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        SEOMeta::addKeyword($keywords);

        return view('public.extra-page',compact('subcategories', 'title', 'category'));
    }

    public function detailExtraPage($category, $subcategories, $slugCategory, $slugSubcategory) {
        $subcategory = Subcategory::where('id', $subcategories)->first();
        $title = 'MTD | ' . ucwords($subcategory['subcategory']);

        $packages = SubcategoryPackage::where('subcategory_id', $subcategory['id'])->where('is_active', 'active')->orderBy('package_name', 'asc')->get();

        $seo = CategorySEO::where('subcategory_id', $subcategory['id'])->first();

        $keywords = explode(',', $seo['meta_keywords']);

        SEOTools::setTitle($seo['seo_title'], false);
        SEOTools::setDescription($seo['meta_description'], false);
        SEOTools::opengraph()->setUrl(route('public-extra.detail', [$subcategory['category_id'], $subcategory['id'], $subcategory['slug'], str_replace(' ', '-', $subcategory['subcategory'])]));
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        SEOMeta::addKeyword($keywords);

        return view('public.detail-extra-page', compact('title', 'subcategory', 'packages'));
    }
}
