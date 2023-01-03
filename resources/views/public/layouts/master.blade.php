<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>MTD | {{ $title ? $title : 'Home'}}</title>
  <meta charset="utf-8">
  {{-- <meta name="title" content="home - mame tirta dewata">
  <meta name="description" content="mame tirta dewata tour and travel dan pusat oleh-oleh batam"> --}}
  {!! SEO::generate() !!}


  {{-- {!! seo() !!} --}}

  <meta name="format-detection" content="telephone=no" />
  <link rel="icon" href="{{ asset('template/images/favicon.ico') }}">
  {{-- <link rel="shortcut icon" href="{{ asset('template/images/favicon.ico') }}" /> --}}

  <link rel="stylesheet" href="{{ asset('template/booking/css/booking.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/camera.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/animation.css') }}">
  <script src="{{ asset('template/js/jquery.js') }}"></script>
  <script src="{{ asset('template/js/jquery-migrate-1.2.1.js') }}"></script>
  <script src="{{ asset('template/js/script.js') }}"></script>
  <script src="{{ asset('template/js/superfish.js') }}"></script>
  <script src="{{ asset('template/js/jquery.ui.totop.js') }}"></script>
  <script src="{{ asset('template/js/jquery.equalheights.js') }}"></script>
  <script src="{{ asset('template/js/jquery.mobilemenu.js') }}"></script>
  <script src="{{ asset('template/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('template/js/owl.carousel.js') }}"></script>
  <script src="{{ asset('template/js/camera.js') }}"></script>
  <!--[if (gt IE 9)|!(IE)]><!-->
  <script src="{{ asset('template/js/jquery.mobile.customized.min.js') }}"></script>
  <!--<![endif]-->
  {{-- <script src="{{ asset('template/booking/js/booking.js') }}"></script> --}}
  <script>
    $(document).ready(function() {
      jQuery('#camera_wrap').camera({
        loader: false,
        pagination: false,
        minHeight: '444',
        thumbnails: false,
        height: '48.375%',
        caption: true,
        navigation: true,
        fx: 'mosaic'
      });
      /*carousel*/
      var owl = $("#owl");
      owl.owlCarousel({
        items: 2, //10 items above 1000px browser width
        itemsDesktop: [995, 2], //5 items between 1000px and 901px
        itemsDesktopSmall: [767, 2], // betweem 900px and 601px
        itemsTablet: [700, 2], //2 items between 600 and 0
        itemsMobile: [479, 1], // itemsMobile disabled - inherit from itemsTablet option
        navigation: true,
        pagination: false
      });
      $().UItoTop({
        easingType: 'easeOutQuart'
      });
    });
  </script>
  <!--[if lt IE 8]>
  <div style=' clear: both; text-align:center; position: relative;'>
   <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
    <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
   </a>
  </div>
  <![endif]-->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <link rel="stylesheet" media="screen" href="css/ie.css">
  <![endif]-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
      
  @stack('addon-css')
</head>

<body class="page1" id="top">
  <!--==============================header=================================-->
  @include('public.layouts.header')
  
  @yield('content')

  @include('public.layouts.sosmed')

  <!--==============================footer=================================-->
  @include('public.layouts.footer')
  
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  @stack('addon-js')  
</body>

</html>
