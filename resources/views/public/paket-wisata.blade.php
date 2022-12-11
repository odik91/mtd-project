@extends('public.layouts.master')

@section('content')
  <div class="bg-info"
    style="height: 350px; background-image: url('{{ asset('template/images/img-01.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
      <div class="brand-name text-center" style="padding-top: 15rem">
        <img class="slide-top" src="{{ asset('template/images/logo-mtd.png') }}" alt="Your Happy Family">
        <h1 class="text-white focus-in-expand" style="margin-top: -5rem">MAME TIRTA DEWATA</h1>
      </div>
    </div>
  </div>

  {{-- destinasi wisata --}}
  <div>
    <div class="container_12">
      <div class="grid_12" style="background-color: #fff3e6; padding: 30px;">
        <h3 class="head1" style="text-align: center; color: #f3aa29; margin-top: -15px">
          PAKET WISATA
        </h3>
        <br>
        <div class="d-flex justify-content-center flex-wrap">
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img1.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">Barcelona</div>
              <div class="price">FROM<span>$ 1000</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img1.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">ITALY</div>
              <div class="price">FROM<span>$ 1000</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img2.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">GOA</div>
              <div class="price">FROM<span>$ 1.500</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">PARIS</div>
              <div class="price">FROM<span>$ 1.600</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">PARIS</div>
              <div class="price">FROM<span>$ 1.600</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">PARIS</div>
              <div class="price">FROM<span>$ 1.600</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">PARIS</div>
              <div class="price">FROM<span>$ 1.600</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
          <div class="banner m-2" style="width: 250px;">
            <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
            <div class="label" style="margin-top: -5rem">
              <div class="title">PARIS</div>
              <div class="price">FROM<span>$ 1.600</span></div>
              <a href="#">LEARN MORE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end destinasi wisata --}}
@endsection
