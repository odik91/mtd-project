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
  <div class="container_12">
    <div class="text-center mt-4">
      @if ($logoSlider['logo_about'] != '')
        <img src="{{ asset('images/logo/' . $logoSlider['logo_about']) }}" alt="mtd-color.png" style="width: 200px">
      @else
        <img src="{{ asset('template/images/mtd-color.png') }}" alt="mtd-color.png" style="width: 200px">
      @endif
    </div>
    <h2 class="text-center pt-4 m-0 text-shadow text-warning">PT MAME TIRTA DEWATA</h2>
    <div class="map">
      <div class="mb-4 text-center">
        <span class="blog">
          {{ $elevatorPitch['content'] }}
        </span>
      </div>
      <div class="clear"></div>
      <figure class="">
        @if (empty($about['maps']))
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.073743136394!2d104.09675885390627!3d1.134014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98629440c5757%3A0x7e57149ff963910c!2sPuri%20Selebriti%201!5e0!3m2!1sen!2sid!4v1670749845476!5m2!1sen!2sid"
            width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        @else
          {!! $about['maps'] !!}
        @endif
      </figure>
      <address>
        @php
          $contacts = App\Models\ContactPerson::get();
        @endphp
        <dl>
          <dt>{{ ucwords($about['alamat']) }}<br>
            {{ ucwords($about['kelurahan']) }} {{ ucwords($about['kecamatan']) }} {{ ucwords($about['kabupaten']) }}<br>
            {{ ucwords($about['provinsi']) }}
          </dt>
          @if (sizeof($contacts) > 0)
            @foreach ($contacts as $contact)
              @if ($contact['contact_media'] == 'email')
                <dd>E-mail: <a href="mailto:{{ $contact['contact'] }}" class="col1">{{ $contact['contact'] }}</a></dd>
              @else
                <dd><span>{{ ucwords($contact['contact_media']) }}: </span>{{ $contact['contact'] }}</dd>
              @endif
            @endforeach
          @endif
        </dl>
      </address>
    </div>
  </div>
  <br>

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
