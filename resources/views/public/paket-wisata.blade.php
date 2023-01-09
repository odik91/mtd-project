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

  {{-- destinasi wisata --}}
  <div>
    <div class="container_12">
      <div class="grid_12" style="background-color: #fff3e6; padding: 30px;">
        <h3 class="head1" style="text-align: center; color: orange; margin-top: -15px">
          PAKET WISATA
        </h3>
        <br>
        <div class="d-flex justify-content-center flex-wrap">
          @foreach ($destinations as $destination)
            <div class="banner m-2"
              style="width: 250px; height: 340px; background-image: url('{{ asset('images/destination/' . $destination['thumbnail']) }}'); background-size: cover; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
              {{-- <img src="{{ asset('images/destination/' . $destination['thumbnail']) }}" alt="{{ $destination['thumbnail'] }}"> --}}
              <div class="label"
                style="margin-top: -7rem; background: rgba(0, 0, 0, 0.4); padding-top: 30px; padding-bottom: 30px">
                <div class="title">{{ strtoupper($destination['travel_name']) }}</div>
                <div class="price">{{ strtoupper($destination['second_text']) }}<span
                    style="color: orange">{{ strtoupper($destination['start_price']) }}</span></div>
                <a href="{{ route('detail-wisata', $destination['slug']) }}">LEARN MORE</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  {{-- end destinasi wisata --}}
@endsection
