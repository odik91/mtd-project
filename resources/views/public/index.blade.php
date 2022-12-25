@extends('public.layouts.master')

@push('addon-css')
  <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/slider-updown.css') }}">
@endpush

@section('content')
  <div
    style="width: 100%; position: absolute; top: 12.5rem; z-index: 2; margin:0 auto; display: flex; justify-content: center">
    @php
      $logoSlider = App\Models\About::first();
    @endphp
    <img class="slide-top"
      src="{{ $logoSlider['logo_slider'] != '' ? asset('images/logo/' . $logoSlider['logo_slider']) : asset('template/images/logo-mtd.png') }}"
      alt="Your Happy Family">
  </div>
  <div class="slider_wrapper">
    <div id="camera_wrap">
      @foreach ($mainSliders as $mainSlider)
        <div data-src="{{ asset('images/sliders/' . $mainSlider['image']) }}">
          <div class="caption fadeIn" style="text-shadow: -4px 4px 10px rgba(0,0,0,0.6);">
            <h2 class="header-title shadow-sm">{{ strtoupper($mainSlider['first_text']) }}</h2>
            <div class="price">
              <p>{{ ucfirst($mainSlider['second_text']) }}</p>
              <span>{{ strtoupper($mainSlider['third_text']) }}</span>
            </div>
            <a href="{{ !empty($mainSlider['link']) ? $mainSlider['link'] : '#' }}">KEPOIN YUK...</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <!--==============================Content=================================-->
  <div class="content">
    {{-- <div class="ic">More Website Templates @ TemplateMonster.com - February 10, 2014!</div> --}}
    <div class="container_12">
      @foreach ($services as $key => $service)
        <div class="grid_4">
          <div class="banner"
            style="box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.4); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.4); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.4);">
            @if ($key == 0)
              <img src="{{ asset('template/images/bc01.jpg') }}" alt="{{ $service['image'] }}"
                style="filter: brightness(50%)">
            @elseif($key == 1)
              <img src="{{ asset('template/images/bc02.jpg') }}" alt="{{ $service['image'] }}"
                style="filter: brightness(50%)">
            @else
              <img src="{{ asset('template/images/bc03.jpg') }}" alt="{{ $service['image'] }}"
                style="filter: brightness(50%)">
            @endif
            {{-- <img src="{{ asset('images/banner/' . $service['image']) }}" alt=""> --}}
            <div class="label">
              <div class="title" style="color: #f3aa29">{{ strtoupper($service['first_text']) }}</div>
              <div class="price">
                {{ strtoupper($service['second_text']) }}<span>{{ strtoupper($service['third_text']) }}</span></div>
              <a href="{{ !empty($service['link']) ? $service['link'] : '#' }}">LEARN MORE</a>
            </div>
          </div>
        </div>
      @endforeach
      {{-- <div class="grid_4">
        <div class="banner">
          <img src="{{ asset('template/images/ban_img1.jpg') }}" alt="">
          <div class="label">
            <div class="title">TICKETING</div>
            <div class="price">TERSEDIA<span>PESAWAT & KAPAL</span></div>
            <a href="#">LEARN MORE</a>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="banner">
          <img src="{{ asset('template/images/ban_img2.jpg') }}" alt="">
          <div class="label">
            <div class="title">PAKET TRAVEL</div>
            <div class="price">PILIHAN<span>DALAM & LUAR NEGERI</span></div>
            <a href="#">LEARN MORE</a>
          </div>
        </div>
      </div>
      <div class="grid_4">
        <div class="banner">
          <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
          <div class="label">
            <div class="title">PUSAT OLEH-OLEH</div>
            <div class="price">TERSEDIA<span>ANEKA BUAH TANGAN</span></div>
            <a href="#">LEARN MORE</a>
          </div>
        </div>
      </div> --}}
    </div>

    {{-- section elevator pitch --}}
    <div>
      <div class="container_12 shadow-sm">
        <div class="grid_12"
          style="background-color: #fff3e6; padding: 30px; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
          <div class="text-center">
            <img src="{{ asset('template/images/mtd-color.png') }}" alt="mtd-color.png" style="width: 100px">
          </div>
          <h3 class="head1"
            style="text-align: center; margin-top: -20px; color: #f3aa29; text-shadow: -4px 4px 10px rgba(0,0,0,0.2);">
            {{ strtoupper($elevatorPitch['title']) }}
          </h3>
          <div style="text-align: center; margin-top: -25px; margin-bottom: 40px;">
            {{ $elevatorPitch['content'] }}
          </div>
        </div>
      </div>
    </div>
    {{-- end section elevator pitch --}}

    {{-- our services --}}
    <div class="container_12 my-4">
      <h3 class="text-center mx-2"><u>Our Services</u></h3>
      <div class="d-flex justify-content-center d-flex justify-content-center flex-wrap">
        @foreach ($ourServices as $ourService)
          <div class="mx-3 mb-4">
            <div class="rounded-circle services">
              <div class="align-middle text-center text-white">
                <i class="{{ $ourService['icon'] }}" style="font-size: 75px;"></i>
              </div>
            </div>
            <h5 class="text-center" style="margin-top: -100px; color: #f3aa29;">
              {{ ucwords($ourService['service_name']) }}</h5>
          </div>
        @endforeach
      </div>
    </div>
    {{-- end our services --}}

    {{-- destinasi wisata --}}
    <div>
      <div class="container_12">
        <div class="grid_12"
          style="background-color: #fff3e6; padding: 30px; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
          <h3 class="head1" style="text-align: center; color: #f3aa29; margin-top: -15px">
            PAKET WISATA
          </h3>
          <br>
          <div class="container">
            <div class="row">
              <div class="d-flex justify-content-center flex-wrap w-100">
                @foreach ($travels as $travel)
                  <div class="banner m-2">
                    <img src="{{ asset('images/destination/' . $travel['thumbnail']) }}"
                      alt="{{ $travel['thumbnail'] }}" style="filter: brightness(80%);">
                    <div class="label" style="text-shadow: -4px 4px 10px rgba(0,0,0,0.6);">
                      <div class="title" style="color: #ff7300">{{ strtoupper($travel['travel_name']) }}</div>
                      <div class="price">
                        {{ strtoupper($travel['second_text']) }}<span>{{ $travel['start_price'] }}</span></div>
                      <a href="{{ route('detail-wisata', $travel['slug']) }}">SELENGKAPNYA</a>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="label text-center mb-4">
            <a href="{{ route('paket-wisata') }}" class="btn-cta-link">LIHAT SEMUA PAKET</a>
          </div>
        </div>
      </div>
    </div>
    {{-- end destinasi wisata --}}

    {{-- oleh-oleh khas batam --}}
    <div class="container_12 my-4">
      <h3 class="text-center mx-2">OLEH-OLEH KHAS BATAM</h3>
      <div>
        <div class="container_12">
          <div class="owl-carousel text-center" id="owl-carousel-1">
            @foreach ($suvenirs as $suvenir)
              <div class="mx-3 mb-4 pt-2">
                <div class="rounded-circle services"
                  style="background-image: url('{{ asset('images/suvenirs/' . $suvenir['thumbnail']) }}'); background-size: contain;">
                </div>
                <h5 class="text-center" style="margin-top: -100px;">
                  <a href="#">{{ strtoupper($suvenir['suvenir_name']) }}</a>
                </h5>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      {{-- end oleh-oleh khas batam --}}
    </div>

    {{-- section testimoni --}}
    <div>
      <div class="container_12">
        <div class="grid_12"
          style="padding: 0 10px; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
          <h3 class="head1 pt-5" style="text-align: center; color: #f3aa29;">
            Testimoni Pelanggan
          </h3>
          <div style="text-align: center; margin-top: -30px; margin-bottom: 10px;">
            <div class="owl-carousel text-center" id="owl-carousel-2">
              {{-- <div class="container bg-light p-4">
                <div class="rounded-circle testimoni">
                  <div class="align-middle text-center text-white">
                    <img src="{{ asset('images/suvenirs/1671369288VC673mHGzhq2y62qIgc9783EXC6g2X9ldOzYgahu.jpg') }}"
                      alt="">
                  </div>
                </div>
                <h5 class="text-center pt-2"><i>John Doe</i></h5>
                <p style="margin-top: -5px"><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore etdolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex</i></p>
              </div> --}}
              @if (sizeof($testimonies) > 0)
                @foreach ($testimonies as $testimoni)
                  <div class="container bg-light pt-2 px-4">
                    <h6 class="text-center pt-0" style="letter-spacing: 2px; font-weight: 600">{{ $testimoni['name'] }}</h6>
                    <blockquote style="margin-top: -5px"><i>{{ $testimoni['content'] }}</i></blockquote>
                  </div>
                @endforeach
              @else
                <div class="container bg-light p-4">
                  <h5 class="text-center pt-2">Belum ada testimoni</h5>
                  <p style="margin-top: -5px"><i>Jadilah orang pertama yang memberikan testimoni</i></p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end section testimoni --}}

    {{-- form testimoni --}}
    <div class="container_12 mt-4" style="margin-bottom: -50px">
      <div class="grid_12"
        style="background-color: #fff3e6; padding: 0 10px; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
        <div class="container">
          <div class="row">
            <div class="col">
              <h3 class="text-center mt-4 pt-4">Tulis Testimoni Anda</h3>
              <form method="POST" action="{{ route('home.store') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                      name="nama" placeholder="Nama" value="{{ old('nama') }}">
                    @error('nama')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group mt-1">
                  <textarea class="form-control @error('testimoni') is-invalid @enderror" id="testimoni" name="testimoni"
                    rows="6" placeholder="Tulis testimoni anda" maxlength="300">{{ old('testimoni') }}</textarea>
                </div>
                @error('testimoni')
                  <span class="error invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <button type="submit" class="btn btn-cta-link mb-4">Buat Testimoni</button>
                <br>
                <br>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end form testimoni --}}
  </div>
@endsection

@push('addon-js')
  {{-- owl carrousel --}}
  {{-- <script src="j{{ asset('owl/src/js/query.min.js') }}"></script> --}}
  <script src="{{ asset('owl/dist/owl.carousel.min.js') }}"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
      let owl = $('#owl-carousel-1');
      owl.owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            loop: true,
            margin: 10,
          },
          600: {
            items: 2,
            loop: true,
            margin: 10,
          },
          1000: {
            items: 4,
            loop: true,
            margin: 10,
          }
        },
      });

      let owl2 = $('#owl-carousel-2');
      owl2.owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        responsiveClass: true,
      });

    });

    @if ($message = Session::get('success'))
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{!! $message !!}",
      })
    @elseif ($message = Session::get('error'))
      Swal.fire({
        icon: 'error',
        title: 'Opps..',
        text: "{!! $message !!}",
      })
    @endif
  </script>
@endpush
