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
        SEOTools::setTitle('Paket Wisata');
        SEOTools::setDescription('mame tirta dewata tour and travel batam paket wisata');
        SEOTools::opengraph()->setUrl('https://mtd-travel-batam.com/paket-wisata');
        SEOTools::setCanonical('https://mtd-travel-batam.com');
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
        return view('public.contact', compact('title', 'elevatorPitch', 'about'));
    }

    public function travelDetail($slug)
    {
        $travel = Travel::where('slug', $slug)->first();
        $sugests = Travel::whereNotIn('slug', [$slug])->inRandomOrder()->limit(4)->get();
        $packages = TravelPackage::where('travel_id', $travel['id'])->get();
        $title = ucwords($travel['travel_name']);
        return view('public.detail-wisata', compact('title', 'travel', 'packages', 'sugests'));
    }

    public function suvenirs()
    {
        $title = 'Oleh-oleh';
        $suvenirs = Suvenir::where('is_active', 'active')->get();
        $suvenirCategories = SuvenirCategory::get();

        return view('public.suvenir', compact('title', 'suvenirs', 'suvenirCategories'));
    }

    public function detailSuvenir($slug)
    {
        $suvenir = Suvenir::where('slug', $slug)->first();
        $title = 'Oleh-oleh';
        $suvenirCategories = SuvenirCategory::get();
        return view('public.detail-suvenir', compact('title', 'suvenir', 'suvenirCategories'));
    }
}
