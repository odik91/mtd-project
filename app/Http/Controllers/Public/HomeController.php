<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ElevatorPitch;
use App\Models\HomeFirstThreeItem;
use App\Models\HomeSlider;
use App\Models\OurService;
use App\Models\Suvenir;
use App\Models\SuvenirCategory;
use App\Models\Testimoni;
use App\Models\Travel;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Home";
        $mainSliders = HomeSlider::where('is_active', 'active')->get();
        $services = HomeFirstThreeItem::get();
        $elevatorPitch = ElevatorPitch::first();
        $ourServices = OurService::where('is_active', 'active')->limit(5)->get();
        $travels = Travel::where('is_active', 'active')->get();
        $suvenirs = Suvenir::where('is_active', 'active')->get();
        $testimonies = Testimoni::where('publish', 'yes')->get();

        SEOTools::setTitle('Home');
        SEOTools::setDescription('mame tirta dewata tour and travel dan pusat oleh-oleh batam');
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/home');
        SEOTools::setCanonical('https://mtd-travel-batam.com');

        return view('public.index', compact('title', 'mainSliders', 'services', 'elevatorPitch', 'ourServices', 'travels', 'suvenirs', 'testimonies'));
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
                'nama' => 'required|min:3',
                'email' => 'required|email:rfc,dns',
                'testimoni' => 'required|min:5|max:300'
            ],
            [
                'nama.required' => 'Mohon masukkan nama anda',
                'nama.min' => 'Nama minimal 3 karakter',
                'email.required' => 'Mohon masukkan email anda',
                'email.email' => 'Email tidak vaild, coba gunakan gmail atau yahoo anda',
                'testimoni.required' => 'Mohon masukkan testimoni anda',
                'testimoni.min' => 'Minimal 5 karakter',
                'testimoni.max' => 'Maksimal 300 karakter',
            ]
        );

        $data = [
            'email' => $request['email'],
            'name' => $request['nama'],
            'avatar' => 'default.jpg',
            'publish' => 'yes',
            'content' => $request['testimoni']
        ];

        $create = Testimoni::create($data);

        if ($create) {
            Session::flash('success', "Testimoni berhasil dibuat");
        } else {
            Session::flash('error', "Testimoni gagal dibuat");
        }
        return redirect()->route('home.index');
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

    public function travelPackages()
    {
        $title = "Paket Wisata";
        $destinations = Travel::where('is_active', 'active')->get();
        $keywords = ['pt mame tirta dewata', 'mtd tour and travel batam', 'pt mame tirta dewata tour and travel', ];

        foreach ($destinations as $destination) {
            array_push($keywords, 'paket wisata ' . $destination['travel_name']);
        }

        SEOTools::setTitle('Paket Wisata');
        SEOTools::setDescription('mame tirta dewata tour and travel batam paket wisata');
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/paket-wisata');
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        SEOMeta::addKeyword($keywords);

        return view('public.paket-wisata', compact('title', 'destinations'));
    }

    public function travelPackageDetail($slug)
    {
        $destination = Travel::where('slug', $slug)->first();
        $title = $destination['travel_name'];
    }

    public function singlePage()
    {
        $title = "Page Detail";
        return view('public.single-page', compact('title'));
    }

    public function contact()
    {
        $title = "About";
        $about = About::first();
        $elevatorPitch = ElevatorPitch::first();
        SEOTools::setTitle($title, false);
        SEOTools::setDescription("PT Mame Tirta Dewata $elevatorPitch->content");
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/about');
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        SEOMeta::addKeyword(['pt mame tirta dewata', 'mtd tour and travel batam', 'pt mame tirta dewata tour and travel', 'mame tirta dewata pusat oleh-oleh batam']);
        return view('public.contact', compact('title', 'elevatorPitch', 'about'));
    }

    public function travelDetail($slug)
    {
        $travel = Travel::where('slug', $slug)->first();
        $sugests = Travel::whereNotIn('slug', [$slug])->inRandomOrder()->limit(4)->get();
        $packages = TravelPackage::where('travel_id', $travel['id'])->get();
        $title = ucwords($travel['travel_name']);
        $description = strip_tags($travel['description']);
        $description = substr($description, 0, 150);
        $keywords = ['pt mame tirta dewata', 'mtd tour and travel batam', 'pt mame tirta dewata tour and travel', ];

        array_push($keywords, 'mame tirta dewata wisata ' . $travel['travel_name']);
        array_push($keywords, 'mame tirta dewata wisata ' . $travel['travel_name'] . ' ' . $travel['second_text'] . ' ' . $travel['start_price']);
        array_push($keywords, 'mame tirta dewata wisata ' . $travel['travel_name'] . ' ' . $travel['region'] . ' ' . $travel['country']);

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/detail-wisata/' . $travel['slug']);
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        // SEOMeta::addKeyword(["$description", 'pt mame tirta dewata', 'mtd tour and travel batam', 'pt mame tirta dewata tour and travel', 'mame tirta dewata pusat oleh-oleh batam']);
        SEOMeta::addMeta('article:published_time', $travel['updated_at']->toW3CString(), 'property');
        // SEOMeta::addMeta('article:section', $post->category, 'property');
        SEOMeta::addKeyword($keywords);

        return view('public.detail-wisata', compact('title', 'travel', 'packages', 'sugests'));
    }

    public function suvenirs()
    {
        $title = 'Oleh-oleh';
        $suvenirs = Suvenir::where('is_active', 'active')->get();
        $suvenirCategories = SuvenirCategory::get();
        $keywords = ['mtd travel batam oleh-oleh', 'oleh-oleh', 'suvenir', 'oleh-oleh khas batam', 'suvenir khas batam',];

        foreach ($suvenirs as $suvenir) {
            array_push($keywords, $suvenir['suvenir_name']);
        }

        SEOTools::setTitle('Oleh oleh');
        SEOTools::setDescription('mame tirta dewata tour and travel oleh-oleh batam');
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/paket-wisata');
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        SEOMeta::addKeyword($keywords);

        return view('public.suvenir', compact('title', 'suvenirs', 'suvenirCategories'));
    }

    public function detailSuvenir($slug)
    {
        $suvenir = Suvenir::where('slug', $slug)->first();
        $title = 'Oleh-oleh';
        $suvenirCategories = SuvenirCategory::get();

        $keywords = ['pt mame tirta dewata', 'pusat oleh-oleh batam', ];

        array_push($keywords, $suvenir['suvenir_name']);
        array_push($keywords, $suvenir['suvenir_name'] . ' ' . $suvenir['first_text'] . ' ' . $suvenir['start_price']);

        $description = strip_tags($suvenir['description']);
        $description = substr($description, 0, 150);

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/detail-wisata/' . $suvenir['slug']);
        SEOTools::setCanonical('https://mtd-travel-batam.com');
        // SEOMeta::addKeyword(["$description", 'pt mame tirta dewata', 'mtd tour and travel batam', 'pt mame tirta dewata tour and travel', 'mame tirta dewata pusat oleh-oleh batam']);
        SEOMeta::addMeta('article:published_time', $suvenir['updated_at']->toW3CString(), 'property');
        // SEOMeta::addMeta('article:section', $post->category, 'property');
        SEOMeta::addKeyword($keywords);

        return view('public.detail-suvenir', compact('title', 'suvenir', 'suvenirCategories'));
    }
}
