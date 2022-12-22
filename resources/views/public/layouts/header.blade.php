<header>
  <div class="container_12">
    <!-- <div class="grid_12">
                <div class="menu_block">
                    <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                        <ul class="sf-menu">
                            <li class="current"><a href="index.html">HOME</a></li>
                            <li><a href="index-1.html">TOUR & TRAVEL</a></li>
                            <li><a href="index-2.html">OLEH-OLEHNYA BATAM</a></li>
                            <li><a href="index-3.html">BLOG</a></li>
                            <li><a href="index-4.html">CONTACT US</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </div>
            </div> -->

    <div class="grid_12">
      <nav class="navbar navbar-expand-lg navbar-light rounded"
        style="background-color: rgba(255, 173, 0, 0.69); box-shadow: 3px 3px 3px #001c35;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10"
          aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'Home' ? 'current' : '' }}"
                href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'Paket Wisata' ? 'current' : '' }}"
                href="{{ route('paket-wisata') }}">Tour & Travel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'Oleh-oleh' ? 'current' : '' }}" href="{{ route('oleh-oleh') }}">Oleh-oleh</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2" href="#">Berita</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'About' ? 'current' : '' }}" href="{{ route('contact') }}">About</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>


  </div>
</header>
