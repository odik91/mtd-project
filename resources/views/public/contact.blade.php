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
  <div class="container_12">
    <div class="grid_5">
      <h3>CONTACT INFO</h3>
      <img src="{{ asset('template/images/logo-mtd.png') }}" alt="Your Happy Family"> 
      <div class="map">
        <p><span class="blog">Maecenas vehicula egestas venenatis. Duis massa elit, auctor non pellentesque vel aliquet
            sit amet erat. Nullam eget dignissim nisi, aliquam feugiat nibh. </span></p>
        <div class="clear"></div>
        <figure class="">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.073743136394!2d104.09675885390627!3d1.134014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98629440c5757%3A0x7e57149ff963910c!2sPuri%20Selebriti%201!5e0!3m2!1sen!2sid!4v1670749845476!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </figure>
        <address>
          <dl>
            <dt>The Company Name Inc. <br>
              8901 Marmora Road,<br>
              Glasgow, D04 89GR.
            </dt>
            <dd><span>Freephone:</span>+1 800 559 6580</dd>
            <dd><span>Telephone:</span>+1 800 603 6035</dd>
            <dd><span>FAX:</span>+1 800 889 9898</dd>
            <dd>E-mail: <a href="#" class="col1">mail@demolink.org</a></dd>
          </dl>
        </address>
      </div>
    </div>
    <div class="grid_6 prefix_1">
      <h3>GET IN TOUCH</h3>
      <form id="form">
        <div class="success_wrapper">
          <div class="success-message">Contact form submitted</div>
        </div>
        <label class="name">
          <input type="text" placeholder="Name:" />
          <span class="empty-message">*This field is required.</span>
          <span class="error-message">*This is not a valid name.</span>
        </label>
        <label class="email">
          <input type="text" placeholder="Email:" />
          <span class="empty-message">*This field is required.</span>
          <span class="error-message">*This is not a valid email.</span>
        </label>
        <label class="country">
          <input type="text" placeholder="Country:" />
          <span class="empty-message">*This field is required.</span>
          <span class="error-message">*This is not a valid phone.</span>
        </label>
        <label class="message">
          <textarea placeholder="Message:"></textarea>
          <span class="empty-message">*This field is required.</span>
          <span class="error-message">*The message is too short.</span>
        </label>
        <div>
          <div class="clear"></div>
          <div class="btns">
            <a href="#" data-type="reset" class="btn">Clear</a>
            <a href="#" data-type="submit" class="btn">Submit</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- end detail wisata --}}
@endsection
