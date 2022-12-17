@extends('public.layouts.master')

@push('addon-css')
  <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('owl/dist/assets/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/slider-updown.css') }}">
@endpush

@section('content')
  <div
    style="width: 100%; position: absolute; top: 12.5rem; z-index: 2; margin:0 auto; display: flex; justify-content: center">
    <img class="slide-top" src="{{ asset('template/images/logo-mtd.png') }}" alt="Your Happy Family">
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
            <a href="{{ !empty($mainSlider['link']) ? $mainSlider['third_text'] : '#' }}">LEARN MORE</a>
          </div>
        </div>
      @endforeach
      {{-- <div data-src="{{ asset('template/images/img-01.jpg') }}">
      <div class="caption fadeIn">
        <h2 class="header-title">Tour & Travel</h2>
        <div class="price">
          Di sini aja
          <span>MAME TIRTA DEWATA TOUR & TRAVEL</span>
        </div>
        <a href="#">LEARN MORE</a>
      </div>
    </div>
    <div data-src="{{ asset('template/images/slide1.jpg') }}">
      <div class="caption fadeIn">
        <h2 class="header-title">PUSAT OLEH-OLEH BATAM</h2>
        <div class="price">
          Jalan jalan ga lengkap tanpa oleh-oleh
          <span>Yuk liat-liat di sini</span>
        </div>
        <a href="#">LEARN MORE</a>
      </div>
    </div>
    <div data-src="{{ asset('template/images/slide2.jpg') }}">
      <div class="caption fadeIn">
        <h2 class="header-title">TIKET PESAWAT & KAPAL</h2>
        <div class="price">
          READY....
          <span>MARI</span>
        </div>
        <a href="#">LEARN MORE</a>
      </div>
    </div> --}}
    </div>
  </div>
  <!--==============================Content=================================-->
  <div class="content">
    {{-- <div class="ic">More Website Templates @ TemplateMonster.com - February 10, 2014!</div> --}}
    <div class="container_12">
      <div class="grid_4">
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
      </div>
    </div>

    {{-- section elevator pitch --}}
    <div>
      <div class="container_12">
        <div class="grid_12" style="background-color: #fff3e6; padding: 30px;">
          <h3 class="head1" style="text-align: center; color: #f3aa29;">
            MAMAE TIRTA DEWATA TOUR & TRAVEL
          </h3>
          <div style="text-align: center; margin-top: -20px; margin-bottom: 40px;">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum."
          </div>
        </div>
      </div>
    </div>
    {{-- end section elevator pitch --}}

    {{-- our services --}}
    <div class="container_12 my-4">
      <h3 class="text-center mx-2"><u>Our Services</u></h3>
      <div class="d-flex justify-content-center d-flex justify-content-center flex-wrap">
        <div class="mx-3 mb-4">
          <div class="rounded-circle services">
            <div class="align-middle text-center text-white">
              <i class="fa-solid fa-plane" style="font-size: 75px;"></i>
            </div>
          </div>
          <h5 class="text-center" style="margin-top: -110px;">Tiket Pesawat</h5>
        </div>
        <div class="mx-3 mb-4">
          <div class="rounded-circle services">
            <div class="align-middle text-center text-white">
              <i class="fa-solid fa-ship" style="font-size: 75px;"></i>
            </div>
          </div>
          <h5 class="text-center" style="margin-top: -110px;">Tiket Kapal</h5>
        </div>
        <div class="mx-3 mb-4">
          <div class="rounded-circle services">
            <div class="align-middle text-center text-white">
              <i class="fa-solid fa-suitcase-rolling" style="font-size: 75px;"></i>
            </div>
          </div>
          <h5 class="text-center" style="margin-top: -110px;">Paket Wisata</h5>
        </div>
        <div class="mx-3 mb-4">
          <div class="rounded-circle services">
            <div class="align-middle text-center text-white">
              <i class="fa-solid fa-gift" style="font-size: 75px;"></i>
            </div>
          </div>
          <h5 class="text-center" style="margin-top: -110px;">Oleh-oleh</h5>
        </div>
      </div>
    </div>
    {{-- end our services --}}

    {{-- destinasi wisata --}}
    <div>
      <div class="container_12">
        <div class="grid_12" style="background-color: #fff3e6; padding: 30px;">
          <h3 class="head1" style="text-align: center; color: #f3aa29; margin-top: -15px">
            PAKET WISATA
          </h3>
          <br>
          <div class="container">
            <div class="row">
              <div class="d-flex justify-content-center flex-wrap">
                <div class="banner m-2">
                  <img src="{{ asset('template/images/ban_img1.jpg') }}" alt="">
                  <div class="label">
                    <div class="title">Barcelona</div>
                    <div class="price">FROM<span>$ 1000</span></div>
                    <a href="#">LEARN MORE</a>
                  </div>
                </div>
                <div class="banner m-2">
                  <img src="{{ asset('template/images/ban_img1.jpg') }}" alt="">
                  <div class="label">
                    <div class="title">ITALY</div>
                    <div class="price">FROM<span>$ 1000</span></div>
                    <a href="#">LEARN MORE</a>
                  </div>
                </div>
                <div class="banner m-2">
                  <img src="{{ asset('template/images/ban_img2.jpg') }}" alt="">
                  <div class="label">
                    <div class="title">GOA</div>
                    <div class="price">FROM<span>$ 1.500</span></div>
                    <a href="#">LEARN MORE</a>
                  </div>
                </div>
                <div class="banner m-2">
                  <img src="{{ asset('template/images/ban_img3.jpg') }}" alt="">
                  <div class="label">
                    <div class="title">PARIS</div>
                    <div class="price">FROM<span>$ 1.600</span></div>
                    <a href="#">LEARN MORE</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="label text-center">
            <a href="#" class="btn-cta-link">LIHAT SEMUA PAKET</a>
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
            <div class="mx-3 mb-4 pt-2">
              <div class="rounded-circle services"
                style="background-image: url('{{ asset('images/public/luti_gendang.jpg') }}'); background-size: contain;">
              </div>
              <h5 class="text-center" style="margin-top: -110px;">
                <a href="#">Luti Gendang</a>
              </h5>
            </div>
            <div class="mx-3 mb-4 pt-2">
              <div class="rounded-circle services"
                style="background-image: url('{{ asset('images/public/bolu_lapis.jpg') }}'); background-size: contain;">
              </div>
              <h5 class="text-center" style="margin-top: -110px;"><a href="#">Bolu Lapis Marmer</a></h5>
            </div>
            <div class="mx-3 mb-4 pt-2">
              <div class="rounded-circle services"
                style="background-image: url('{{ asset('images/public/molen-bilis.jpeg') }}'); background-size: contain;">
              </div>
              <h5 class="text-center" style="margin-top: -110px;"><a href="#">Molen Bilis</a></h5>
            </div>
            <div class="mx-3 mb-4 pt-2">
              <div class="rounded-circle services"
                style="background-image: url('{{ asset('images/public/kaos.jpeg') }}'); background-size: contain;">
              </div>
              <h5 class="text-center" style="margin-top: -110px;"><a href="#">Kaos</a></h5>
            </div>
          </div>
        </div>
      </div>
      {{-- end oleh-oleh khas batam --}}
    </div>

    {{-- section testimoni --}}
    <div>
      <div class="container_12">
        <div class="grid_12" style="background-color: #fff3e6; padding: 0 10px;">
          <h3 class="head1" style="text-align: center; color: #f3aa29;">
            Testimoni Pelanggan
          </h3>
          <div style="text-align: center; margin-top: -10px; margin-bottom: 40px;">
            <div class="owl-carousel text-center" id="owl-carousel-2">
              <div class="container bg-light p-4">
                <div class="rounded-circle testimoni">
                  <div class="align-middle text-center text-white">
                    <i class="fa-solid fa-user" style="font-size: 50px;"></i>
                  </div>
                </div>
                <h5 class="text-center" style="margin-top: -50px">John Doe</h5>
                <p style="margin-top: -5px"><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore etdolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex</i></p>
              </div>
              <div class="container bg-light p-4">
                <div class="rounded-circle testimoni">
                  <div class="align-middle text-center text-white">
                    <i class="fa-solid fa-user" style="font-size: 50px;"></i>
                  </div>
                </div>
                <h5 class="text-center" style="margin-top: -50px">Adam</h5>
                <p style="margin-top: -5px"><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    tempor incididunt ut labore etdolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex</i></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end section testimoni --}}

    {{-- form testimoni --}}
    <div class="container_12">
      <div class="grid_12">
        <div class="container">
          <div class="row">
            <div class="col">
              <h3 class="text-center">TULIS TESTIMONI ANDA</h3>
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="nama">Password</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                  </div>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                  <label class="custom-file-label" for="validatedCustomFile">Pilih avatar</label>
                </div>
                <div class="form-group mt-1">
                  <label for="testimoni">Testimoni</label>
                  <textarea class="form-control" id="isi" rows="6"></textarea>
                </div>
                <button type="submit" class="btn-cta-link">Buat Testimoni</button>
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
  </script>
@endpush
