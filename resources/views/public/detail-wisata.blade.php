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

  {{-- detail wisata --}}
  <div class="content">
    <div class="container_12">
      <div class="grid_7">
        <h3>{{ strtoupper($title) }}</h3>
        <div class="blog" style="margin-top: -30px">
          <time datetime="2014-10-01">Info<span>Detail</span></time>
          <div class="extra_wrapper">
            <div class="text1 col1"><a>{{ strtoupper($travel['country']) }}</a></div>Destination
            <a href="#">{{ ucwords($travel['region']) }}</a>
          </div>
          <div class="clear"></div>
          <img src="{{ asset('images/destination/' . $travel['image']) }}" alt="" class="img_inner">
          {!! $travel['description'] !!}
        </div>
      </div>
      <div class="grid_4 prefix_1">
        <h3 class="head1" style="margin-top: 30px; margin-bottom: 20px">PAKET WISATA</h3>
        @if (count($packages) > 0)
          @foreach ($packages as $key => $package)
            <div class="card mb-4 std-shadow">
              <div class="card-header text-center">
                Paket {{ ++$key }}
              </div>
              <div class="card-body" style="margin-top: -95px">
                <h5 class="card-title text-center text-info">{{ ucfirst($package['package_name']) }}</h5>
                <p class="card-text">{!! strip_tags(substr($package['description'], 0, 100)) !!}...</p>
                <div class="text-center mb-3" style="margin-top: -15px">
                  <a href="#" class="btn btn-primary" data-toggle="modal"
                    data-target="#package-{{ $package['id'] }}">Lihat</a>
                </div>
              </div>
              {{-- modal --}}
              <!-- Modal -->
              <div class="modal fade" id="package-{{ $package['id'] }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header px-4">
                      <h5 class="modal-title" id="staticBackdropLabel" style="margin-top: -110px">Paket
                        {{ $key }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body mt-1 px-4">
                      <h3 style="margin-top: -70px; margin-bottom:10px" class="text-center">
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
            <div class="card-body" style="margin-top: -95px">
              <h5 class="card-title text-center text-info">Belum Tersedia Paket</h5>
              <p class="card-text text-center">Request paket sekarang!!!</p>
              {{-- <div class="text-center mb-3" style="margin-top: -15px">
                <a href="#" class="btn btn-primary" data-toggle="modal"
                  data-target="#package-{{ $package['id'] }}">Lihat</a>
              </div> --}}
            </div>
            {{-- modal --}}
            <!-- Modal -->
            /
            {{-- end modal --}}
          </div>
        @endif
      </div>
    </div>
    <div class="container_12 std-shadow" style="margin-bottom: -80px; margin-top: 30px">
      <h3 class="text-center pb-4" style="padding-top: 30px">Paket Lainnya</h3>
      <div class="d-flex justify-content-center flex-wrap w-100">
        @foreach ($sugests as $sugest)
          <div class="banner m-2 std-shadow">
            <img src="{{ asset('images/destination/' . $sugest['thumbnail']) }}" alt="{{ $sugest['thumbnail'] }}"
              style="filter: brightness(90%);">
            <div class="label" style="text-shadow: -4px 4px 10px rgba(0,0,0,0.6);">
              <div class="title" style="color: #ff7300">{{ strtoupper($sugest['travel_name']) }}</div>
              <div class="price">
                {{ strtoupper($sugest['second_text']) }}<span>{{ $sugest['start_price'] }}</span></div>
              <a href="{{ route('detail-wisata', $sugest['slug']) }}">SELENGKAPNYA</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- end detail wisata --}}
@endsection

@push('addon-css')
  <style>
    .std-shadow {
      box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
      -webkit-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: -1px 1px 28px 0px rgba(0, 0, 0, 0.2);
    }
  </style>
@endpush
