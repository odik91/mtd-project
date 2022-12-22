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
        <h3 class="head1 text-info" style="text-align: center; margin-top: -15px">
          Oleh-oleh
        </h3>
        <div class="container bg-light p-3 std-shadow">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Semua Kategori</button>
            </li>
            @foreach ($suvenirCategories as $key => $suvenirCategory)
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="extra-tab-{{ $suvenirCategory['id'] }}-tab" data-toggle="tab"
                  data-target="#extra-tab-{{ $suvenirCategory['id'] }}" type="button" role="tab"
                  aria-controls="extra-tab-{{ $suvenirCategory['id'] }}"
                  aria-selected="false">{{ ucwords($suvenirCategory['name']) }}</button>
              </li>
            @endforeach
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="container mt-5 mx-0">
                <div class="d-flex justify-content-around flex-wrap w-100">
                  @foreach ($suvenirs as $suvenir)
                    <div class="banner m-2"
                      style="width: 250px; height: 340px; background-image: url('{{ asset('images/suvenirs/' . $suvenir['thumbnail']) }}'); background-size: cover; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
                      <div class="label"
                        style="margin-top: -7rem; background: rgba(0, 0, 0, 0.4); padding-top: 30px; padding-bottom: 30px">
                        <div class="title">{{ strtoupper($suvenir['suvenir_name']) }}</div>
                        <div class="price">{{ strtoupper($suvenir['first_text']) }}<span
                            style="color: orange">{{ strtoupper($suvenir['start_price']) }}</span></div>
                        <a href="{{ route('oleh-oleh.single', $suvenir['slug']) }}">LEARN MORE</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            @foreach ($suvenirCategories as $key => $suvenirCategory)
              <div class="tab-pane fade" id="extra-tab-{{ $suvenirCategory['id'] }}" role="tabpanel"
                aria-labelledby="extra-tab-{{ $suvenirCategory['id'] }}-tab">
                <div class="container mt-5 mx-0">
                  <div class="d-flex justify-content-around flex-wrap w-100">
                    @foreach (App\Models\Suvenir::where('suvenir_category_id', $suvenirCategory['id'])->get() as $suvenir)
                      <div class="banner m-2"
                        style="width: 250px; height: 340px; background-image: url('{{ asset('images/suvenirs/' . $suvenir['thumbnail']) }}'); background-size: cover; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
                        <div class="label"
                          style="margin-top: -7rem; background: rgba(0, 0, 0, 0.4); padding-top: 30px; padding-bottom: 30px">
                          <div class="title">{{ strtoupper($suvenir['suvenir_name']) }}</div>
                          <div class="price">{{ strtoupper($suvenir['first_text']) }}<span
                              style="color: orange">{{ strtoupper($suvenir['start_price']) }}</span></div>
                          <a href="{{ route('oleh-oleh.single', $suvenir['slug']) }}">LEARN MORE</a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        {{-- <nav class="">
            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="margin-top: -20px">
              <button class="nav-link active" id="nav-alltab-tab" data-toggle="tab"
                data-target="#nav-alltab" type="button" role="tab"
                aria-controls="nav-alltab"
                aria-selected="true">Semua Katgori</button>
              @foreach ($suvenirCategories as $key => $suvenirCategory)
                <button class="nav-link" id="nav-{{ $suvenirCategory['id'] }}-tab" data-toggle="tab"
                  data-target="#nav-{{ $suvenirCategory['id'] }}" type="button" role="tab"
                  aria-controls="nav-{{ $suvenirCategory['id'] }}"
                  aria-selected="true">{{ ucwords($suvenirCategory['name']) }}</button>
              @endforeach
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            @foreach ($suvenirCategories as $key => $suvenirCategory)
              <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="nav-{{ $suvenirCategory['id'] }}"
                role="tabpanel" aria-labelledby="nav-{{ $suvenirCategory['id'] }}-tab">
                <div class="container p-3">
                  <div class="d-flex justify-content-around flex-wrap w-100">
                    <div class="col-sm col-md-4 col-lg-3 m-2 std-shadow">
                      <p>test</p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div> --}}


        {{-- <div class="d-flex justify-content-center flex-wrap">
          @foreach ($destinations as $destination)
            <div class="banner m-2" style="width: 250px; height: 340px; background-image: url('{{ asset('images/destination/' . $destination['thumbnail']) }}'); background-size: fit; box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -webkit-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3); -moz-box-shadow: -1px 1px 28px 0px rgba(0,0,0,0.3);">
              <div class="label" style="margin-top: -7rem; background: rgba(0, 0, 0, 0.4); padding-top: 30px; padding-bottom: 30px">
                <div class="title">{{ strtoupper($destination['travel_name']) }}</div>
                <div class="price">{{ strtoupper($destination['second_text']) }}<span style="color: orange">{{ strtoupper($destination['start_price']) }}</span></div>
                <a href="{{ route('detail-wisata', $destination['slug']) }}">LEARN MORE</a>
              </div>
            </div>
          @endforeach
        </div> --}}
      </div>
    </div>
  </div>
  {{-- end destinasi wisata --}}
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
