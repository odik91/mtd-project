@extends('public.layouts.master')

@section('content')
  <div class="bg-info"
    style="height: 350px; background-image: url('{{ asset('template/images/img-01.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
      <div class="brand-name text-center" style="padding-top: 15rem">
        @php
          $logoSlider = App\Models\About::first();
        @endphp
        <img class="slide-top"
          src="{{ $logoSlider['logo_slider'] != '' ? asset('images/logo/' . $logoSlider['logo_slider']) : asset('template/images/logo-mtd.png') }}"
          alt="Your Happy Family">
        <h1 class="text-white focus-in-expand" style="margin-top: -5rem">MAME TIRTA DEWATA</h1>
      </div>
    </div>
  </div>

  {{-- detail wisata --}}
  <div class="content">
    <div class="container_12">
      <div class="grid_7">
        <h3>Detail Travel Package</h3>
        <div class="blog" style="margin-top: -30px">
          <time datetime="2014-10-01">#1<span>Pack</span></time>
          <div class="extra_wrapper">
            <div class="text1 col1"><a href="#">3 Days 2 Night in UK</a></div>Destination
            <a href="#">United Kingdom</a>
          </div>
          <div class="clear"></div>
          <img src="{{ asset('template/images/page4_img1.jpg') }}" alt="" class="img_inner">
          <p>Cras facilisis, nulla vel viverra auctor, leo gna sodales felis, quis malesuada nibh odio ut velit. Proin
            pharetra luctus diam, a celerisque eros convallis accumsan. </p>Maecenas vehicula egestas venenatis. Duis
          massa elit, auctor non pellentesque vel aliquet sit amet erat. Nullam eget dignissim nisi, aliquam feugiat nibh.
          <br>
        </div>
      </div>
      <div class="grid_4 prefix_1">
        <h3 class="head1" style="margin-top: 30px; margin-bottom: 20px">CATEGORIES</h3>
        <ul class="list">
          <li><a href="#">Suspendisse massa mi </a></li>
          <li><a href="#">Porttitor at velit id </a></li>
          <li><a href="#">Congue adipiscing </a></li>
          <li><a href="#">Vestibulum vitae porta </a></li>
          <li><a href="#">Vivamus ac sodales </a></li>
          <li><a href="#">Massa quis adipiscing </a></li>
          <li><a href="#">Phasellus hendrerit </a></li>
          <li><a href="#">Libero in sapien </a></li>
          <li><a href="#">Dignissim vel imperdiet </a></li>
        </ul>
        <h3 class="head1" style="margin-top: 30px; margin-bottom: 20px">ARCHIVES</h3>
        <ul class="list">
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
        </ul>
      </div>
    </div>
  </div>
  {{-- end detail wisata --}}
@endsection
