<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ElevatorPitch;
use App\Models\HomeFirstThreeItem;
use App\Models\HomeSlider;
use App\Models\OurService;
use App\Models\Suvenir;
use App\Models\Travel;
use Illuminate\Http\Request;

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
        $mainSliders = HomeSlider::get();
        $services = HomeFirstThreeItem::get();
        $elevatorPitch = ElevatorPitch::first();
        $ourServices = OurService::limit(5)->get();
        $travels = Travel::get();
        $suvenirs = Suvenir::get();
        return view('public.index', compact('title', 'mainSliders', 'services', 'elevatorPitch', 'ourServices', 'travels', 'suvenirs'));
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
        //
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

    public function travelPackages() {
        $title = "Paket Wisata";        
        return view('public.paket-wisata', compact('title',));
    }

    public function singlePage() {
        $title = "Page Detail";
        return view('public.single-page', compact('title'));
    }

    public function contact() {
        $title = "Contact";
        return view('public.contact', compact('title'));
    }
}
