<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
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
}
