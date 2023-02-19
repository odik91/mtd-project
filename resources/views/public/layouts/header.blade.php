<header>
  <div class="container_12">
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
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'MTD | Home' ? 'current' : '' }}"
                href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'MTD | Paket Wisata' ? 'current' : '' }}"
                href="{{ route('paket-wisata') }}">Tour & Travel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'MTD | Oleh-oleh' ? 'current' : '' }}"
                href="{{ route('oleh-oleh') }}">Oleh-oleh</a>
            </li>
            @foreach (App\Models\Category::orderBy('category', 'asc')->get() as $category)
              <li class="nav-item">
                <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'MTD | ' . ucwords($category['category']) ? 'current' : '' }}"
                  href="{{ route('public-extra.index', [$category['id'], str_replace(' ', '-', $category['category'])]) }}">{{ ucwords($category['category']) }}</a>
              </li>
            @endforeach
            {{-- <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2" href="#">Berita</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link text-light custom-nav px-2 {{ isset($title) && $title == 'MTD | About' ? 'current' : '' }}"
                href="{{ route('contact') }}">About</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
