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
    {{-- <div class="container px-auto" style="margin-top: -50px;">
      <div class="row px-auto">
        @foreach ($services as $key => $service)
          <div class="col-sm-12 col-md-12 col-lg-4 p-2">
            <div class="card std-shadow mx-auto"
              style="width: 320px; height: 360px; background: rgba(0, 0, 0, .25) url('{{ asset('images/banner/' . $service['image']) }}'); background-size: cover; background-blend-mode: darken;">
              <div class="text-center mt-4 pt-5">
                <div class="pb-4 text-shadow" style="color: #ff7300; font-size: 1.9rem">
                  {{ strtoupper($service['first_text']) }}</div>
                <h6 class="text-white pb-2">{{ strtoupper($service['second_text']) }}</h6>
                <h4 class="text-white mb-3">{{ strtoupper($service['third_text']) }}</h4>
                <a class="button-cta" href="{{ $service['link'] }}">SELENGKAPNYA</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div> --}}
    <div class="container_12">
      @foreach ($services as $key => $service)
        <div class="grid_4 mx-2">
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
            <div class="label" style="margin-top: -70px">
              <div class="title" style="color: #f3aa29">{{ strtoupper($service['first_text']) }}</div>
              <div class="price">
                {{ strtoupper($service['second_text']) }}<span>{{ strtoupper($service['third_text']) }}</span></div>
              <a href="{{ !empty($service['link']) ? $service['link'] : '#' }}">LEARN MORE</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- section elevator pitch --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow px-4" style="background-color: #fff3e6;">
        <div class="card-body">
          <div class="text-center">
            <img src="{{ asset('template/images/mtd-color.png') }}" alt="mtd-color.png" style="width: 100px">
          </div>
          <h3 class="p-0 mb-0 mt-3 mx-0 text-center" style="color: #f3aa29; text-shadow: -4px 4px 10px rgba(0,0,0,0.2);">
            {{ strtoupper($elevatorPitch['title']) }}
          </h3>
          <div class="text-center mt-2 mb-4">
            {{ $elevatorPitch['content'] }}
          </div>
        </div>
      </div>
    </div>
    {{-- end section elevator pitch --}}

    {{-- our services --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow">
        <div class="card-body">
          <h3 class="text-center mx-2 pt-4 mb-2">OUR SERVICES</h3>
        </div>
        <div class="d-flex justify-content-center d-flex justify-content-center flex-wrap">
          @foreach ($ourServices as $ourService)
            <div class="mx-3 mb-5">
              <div class="rounded-circle services">
                <div class="align-middle text-center text-white">
                  <i class="{{ $ourService['icon'] }}" style="font-size: 75px;"></i>
                </div>
              </div>
              <h5 class="text-center mt-3" style="color: #f3aa29;">
                {{ strtoupper($ourService['service_name']) }}</h5>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- destinasi wisata --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow">
        <div class="card-body">
          <h3 class="text-center mx-0 mb-4 mt-2 py-0" style="padding-top: 30px; color: #f3aa29;">PAKET LAINNYA</h3>
          <div class="d-flex justify-content-center flex-wrap w-100">
            @foreach ($travels as $travel)
              <div class="card m-2 std-shadow"
                style="width: 270px; height: 360px; background: rgba(0, 0, 0, .25) url('{{ asset('images/destination/' . $travel['thumbnail']) }}'); background-size: cover; background-blend-mode: darken;">
                <div class="text-center mt-4 pt-5">
                  <div class="pb-4 text-shadow" style="color: #ff7300; font-size: 1.9rem">
                    {{ strtoupper($travel['travel_name']) }}</div>
                  <h6 class="text-white pb-2">{{ strtoupper($travel['second_text']) }}</h6>
                  <h4 class="text-white mb-3">{{ strtoupper($travel['start_price']) }}</h4>
                  <a class="button-cta" href="{{ route('detail-wisata', $travel['slug']) }}">SELENGKAPNYA</a>
                </div>
              </div>
            @endforeach
          </div>
          <div class="label text-center my-4">
            <a href="{{ route('paket-wisata') }}" class="btn-cta-link">LIHAT SEMUA PAKET</a>
          </div>
        </div>
      </div>
    </div>
    {{-- end destinasi wisata --}}

    {{-- oleh-oleh khas batam --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow">
        <div class="card-body">
          <h3 class="text-center mx-0 mb-4 mt-2 py-0" style="padding-top: 30px;">OLEH-OLEH KHAS BATAM</h3>
          <div class="owl-carousel text-center" id="owl-carousel-1">
            @foreach ($suvenirs as $suvenir)
              <div class="mx-3 mb-4 pt-2">
                <div class="rounded-circle services"
                  style="background-image: url('{{ asset('images/suvenirs/' . $suvenir['thumbnail']) }}'); background-size: cover;">
                </div>
                <h5 class="text-center mt-3">
                  <a href="#" style="color: #f3aa29;">{{ strtoupper($suvenir['suvenir_name']) }}</a>
                </h5>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    {{-- oleh-oleh khas batam --}}

    {{-- section testimoni --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow">
        <div class="card-body">
          <h3 class="text-center mt-3" style="color: #f3aa29;">
            TESTIMONI PELANGGAN
          </h3>
          <div class="text-center mt-3">
            <div class="owl-carousel text-center" id="owl-carousel-2">
              @if (sizeof($testimonies) > 0)
                @foreach ($testimonies as $testimoni)
                  <div class="container pt-3 px-4">
                    <h6 class="text-center pt-0" style="letter-spacing: 2px; font-weight: 600">{{ $testimoni['name'] }}
                    </h6>
                    <blockquote class="mt-2"><i>{{ $testimoni['content'] }}</i></blockquote>
                  </div>
                @endforeach
              @else
                <div class="container p-4">
                  <h5 class="text-center pt-2">Belum ada testimoni</h5>
                  <p><i>Jadilah orang pertama yang memberikan testimoni</i></p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- section testimoni --}}

    {{-- form testimoni --}}
    <div class="container px-5 pt-2 mb-4">
      <div class="card mx-2 box-shadow">
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col">
                <h3 class="text-center mt-3 mb-4">Tulis Testimoni Anda</h3>
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
    </div>
    {{-- form testimoni --}}
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

@push('addon-css')
  <style>
    .box-shadow {
      box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.3);
      -webkit-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.3);
      -moz-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.3);
    }

    .card {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .std-shadow {
      box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
      -webkit-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
    }

    .main-description {
      text-transform: none;
    }

    .main-description h1 {
      text-transform: none;
    }

    .main-description h2 {
      text-transform: none;
    }

    .main-description h3 {
      text-transform: none;
    }

    .main-description h4 {
      text-transform: none;
    }

    .main-description h5 {
      text-transform: none;
    }

    .main-description h6 {
      text-transform: none;
    }

    .card h1 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card h2 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card h3 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card h4 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card h5 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card h6 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .card div h3 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .badge {
      width: 45px;
      height: 45px;
      margin-top: 5px;
      margin-bottom: 5px;
      background-image: linear-gradient(to right top, #ffb100, #f0c000, #dccf00, #c5de00, #a8eb12);
    }

    .badge hr {
      margin: 4px 0px 2px 0px;
      border-color: aliceblue;
    }

    .badge span {
      font-size: 0.6rem;
      font-weight: 300;
    }

    .destinasi h5 {
      text-transform: none;
      padding: 0px;
      margin: 0px;
    }

    .destinasi span {
      text-transform: none;
      font-weight: 300
    }

    .button-cta {
      font-size: 14px;
      line-height: 20px;
      color: #c73430;
      text-transform: uppercase;
      display: inline-block;
      background-color: #e5e5e5;
      padding: 5px 18px 4px;
      margin-top: 25px;
      border-radius: 13px;
    }

    .button-cta:hover {
      color: #e5e5e5;
      background-color: #c73430;
    }

    .text-shadow {
      text-shadow: -4px 4px 10px rgba(0, 0, 0, 0.6);
    }

    .content {
      padding-bottom: 5px !important;
    }
  </style>
@endpush
