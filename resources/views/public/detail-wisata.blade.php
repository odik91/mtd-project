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
  <div class="container">
    <div class="row mt-2 pt-2">
      <div class="col-sm-12 col-md-8 col-lg-8 p-2">
        <div class="card">
          <div class="mb-0 px-4 pt-4">
            <h3 class="py-0 my-0">Mame Tirta Dewata Wisata {{ ucwords($travel['travel_name']) }}</h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-start mb-2">
              <div class="badge mb-2 text-center p-1 text-secondary std-shadow">
                <i class="fa fa-suitcase pt-1" aria-hidden="true" style="font-size: 18px"></i>
                <hr>
                <span>Travel</span>
              </div>
              <div class="px-2 py-1 destinasi">
                <h5 class="py-0" style="text-transform: none; color: orange">{{ strtoupper($travel['country']) }}</h5>
                <span>Destinasi wisata:</span> <b class="text-info">{{ ucwords($travel['region']) }}</b>
              </div>
            </div>
            <div class="mb-4">
              <img src="{{ asset('images/destination/' . $travel['image']) }}" alt="" class="img_inner my-0">
            </div>
            <div class="main-description">
              {!! $travel['description'] !!}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 p-2">
        <div class="card p-3">
          <div class="mb-5">
            <h3 class="text-center py-0 mb-0 mt-2">Paket Wisata</h3>
          </div>
          @if (count($packages) > 0)
            @foreach ($packages as $key => $package)
              <div class="card mb-4 std-shadow">
                <div class="card-header text-center">
                  Paket {{ ++$key }}
                </div>
                <div class="card-body p-4">
                  <h5 class="card-title text-center text-info mb-3">{{ strtoupper($package['package_name']) }}</h5>
                  <p class="card-text px-2 my-0">{!! strip_tags(substr($package['description'], 0, 100)) !!}...</p>
                  <div class="text-center">
                    <a href="#" class="btn btn-primary" data-toggle="modal"
                      data-target="#package-{{ $package['id'] }}">Lihat</a>
                  </div>
                </div>
                {{-- modal --}}
                <!-- Modal -->
                <div class="modal fade" id="package-{{ $package['id'] }}" data-backdrop="static" data-keyboard="false"
                  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content px-2">
                      <div class="modal-header px-4">
                        <h5 class="modal-title" id="staticBackdropLabel">Paket
                          {{ $key }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body mt-1 px-4">
                        <h3 class="text-center mb-2">
                          {{ ucfirst($package['package_name']) }}</h3>
                        {!! $package['description'] !!}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end modal --}}
              </div>
            @endforeach
          @else
            <div class="card mb-4 std-shadow">
              <div class="card-header text-center">
                Belum Ada Paket
              </div>
              <div class="card-body">
                <h5 class="card-title text-center text-info">Belum Tersedia Paket</h5>
                <p class="card-text text-center">Request paket sekarang!!!</p>
              </div>
              {{-- modal --}}
              <!-- Modal -->
              {{-- end modal --}}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="container px-2 pt-2 mb-4">
    <div class="card">
      <div class="card-body">
        <h3 class="text-center mx-0 mb-4 mt-2 py-0" style="padding-top: 30px">PAKET LAINNYA</h3>
        <div class="d-flex justify-content-center flex-wrap w-100">
          @foreach ($sugests as $sugest)
            <div class="card m-2 std-shadow"
              style="width: 270px; height: 360px; background: rgba(0, 0, 0, .25) url('{{ asset('images/destination/' . $sugest['thumbnail']) }}'); background-size: cover; background-blend-mode: darken;">
              <div class="text-center mt-4 pt-5">
                <div class="pb-4 text-shadow" style="color: #ff7300; font-size: 1.9rem">{{ strtoupper($sugest['travel_name']) }}</div>
                <h6 class="text-white pb-2">{{ strtoupper($sugest['second_text']) }}</h6>
                <h4 class="text-white mb-3">{{ strtoupper($sugest['start_price']) }}</h4>
                <a class="button-cta" href="{{ route('detail-wisata', $sugest['slug']) }}">SELENGKAPNYA</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  {{-- end detail wisata --}}
@endsection

@push('addon-css')
  <style>
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
      text-shadow: -4px 4px 10px rgba(0,0,0,0.6);
    }
  </style>
@endpush
