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
  <div class="content py-3">
    <div class="container_12">
      <div class="grid_7">
        <h3>{{ strtoupper($title) }}</h3>
        <div class="blog" style="margin-top: -30px">
          <time datetime="2014-10-01">Info<span>Detail</span></time>
          <div class="extra_wrapper mt-1">
            <div class="text1 col1" style="font-size: 1.5rem; text-shadow: -4px 4px 10px rgba(0,0,0,0.2);">
              <a>{{ strtoupper($suvenir['suvenir_name']) }}</a>
            </div> {{ ucwords($suvenir['first_text']) }}&nbsp;
            <a href="#">{{ ucwords($suvenir['start_price']) }}</a>
          </div>
          <img src="{{ asset('images/suvenirs/' . $suvenir['image']) }}" alt="{{ $suvenir['image'] }}"
            class="img_inner pt-2">
          {!! $suvenir['description'] !!}
        </div>
      </div>
      <div class="grid_4 prefix_1">
        <h3 class="head1 text-shadow" style="margin-top: 30px; margin-bottom: 20px; text-align: center">OLEH-OLEH LAINNYA</h3>
        @foreach ($suvenirCategories as $suvenirCategory)
          <div class="card mb-4 std-shadow">
            <div class="card-header text-center">
              {{ ucwords($suvenirCategory['name']) }}
            </div>
            <div class="card-body">
              @foreach (App\Models\Suvenir::where('suvenir_category_id', $suvenirCategory['id'])->limit(10)->get() as $suvenir)
                <a href="{{ route('oleh-oleh.single', $suvenir['slug']) }}" class="row mb-2">
                  <div class="col-sm col-md-3 col-lg-3">
                    <div class="mx-auto"
                      style="width: 25px; height: 25px; border-radius: 50%; background-image: url('{{ asset('template/images/img-01.jpg') }}'); background-size: cover;">
                    </div>
                  </div>
                  <span
                    class="col-sm col-md-7 col-lg-7 text-md-left text-center link-style">{{ ucwords($suvenir['suvenir_name']) }}</span>
                </a>
              @endforeach
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

    .link-style {
      color: #0087e0;
      text-align: left;
      padding-left: 0px;
      padding-right: 0px;
    }

    .text-shadow {
      text-shadow: -4px 4px 10px rgba(0, 0, 0, 0.2);
    }

    @media screen and (max-width: 575px) {
      .link-style {
        text-align: center;
      }
    }
  </style>
@endpush
