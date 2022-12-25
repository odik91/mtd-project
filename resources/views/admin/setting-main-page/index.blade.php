@extends('admin.layouts.master')
@section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaturan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
            <li class="breadcrumb-item active">{{ ucwords($title) }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          {{-- slider utama --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Slider Utama
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Tambah Slider</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" action="{{ route('main-settings.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image"
                              class="custom-file-input @error('image') is-invalid @enderror" id="customFile"
                              accept="image/*" required>
                            <label class="custom-file-label" for="customFile">Pilih background (hanya jpg, png dan
                              bmp)</label>
                            @error('image')
                              <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="first_text"
                            class="form-control @error('first_text') is-invalid @enderror" placeholder="Judul" required>
                          @error('first_text')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="second_text"
                            class="form-control @error('second_text') is-invalid @enderror" placeholder="Slogan" required>
                          @error('second_text')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="third_text"
                            class="form-control @error('third_text') is-invalid @enderror" placeholder="Ajakan" required>
                          @error('third_text')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="text" name="link" class="form-control" id="link"
                          placeholder="Link halaman web (jika tidak ada silakan kosongkan)">
                      </div>
                      <div class="form-group">
                        <select name="is_active" id=""
                          class="form-control @error('is_active') is-invalid @enderror">
                          <option selected disabled>Ditampilkan?</option>
                          <option value="active">Ya</option>
                          <option value="inactive">Tidak</option>
                        </select>
                        @error('image')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <hr>
              <div class="p-4">
                <h4 class="text-center mb-2 text-primary">List Slider</h4>
                <br>
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Background</th>
                      <th>Judul</th>
                      <th>Slogan</th>
                      <th>Ajakan</th>
                      <th>Link</th>
                      <th>Ditampilkan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="slides_status">
                    @foreach ($homeSliders as $key => $homeSlider)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>
                          <img src="{{ asset('images/sliders/' . $homeSlider['image']) }}"
                            alt="{{ $homeSlider['image'] }}" width="70px">
                        </td>
                        <td>{{ ucwords($homeSlider['first_text']) }}</td>
                        <td>{{ ucwords($homeSlider['second_text']) }}</td>
                        <td>{{ ucwords($homeSlider['third_text']) }}</td>
                        <td>{{ $homeSlider['link'] }}</td>
                        <td>
                          <select class="form-control" name="select_slider[]">
                            <option value="active,{{ $homeSlider['id'] }}" {{ $homeSlider['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                            <option value="inactive,{{ $homeSlider['id'] }}" {{ $homeSlider['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-slider-{{ $homeSlider['id'] }}">
                            <i class="fas fa-edit"></i>
                          </button>
                          {{-- modal edit slider --}}
                          <div class="modal fade" id="modal-slider-{{ $homeSlider['id'] }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Slider</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="text-center">
                                    <span class="text-muted">Background Lama</span>
                                    <br>
                                    <img src="{{ asset('images/sliders/' . $homeSlider['image']) }}"
                                      alt="{{ $homeSlider['image'] }}" width="150px" id="{{ $homeSlider['id'] }}">
                                  </div>
                                  <form method="POST" action="{{ route('main-settings.update', $homeSlider['id']) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" name="image"
                                              class="custom-file-input @error('image') is-invalid @enderror"
                                              id="customFile" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Pilih background (hanya
                                              jpg, png dan
                                              bmp)</label>
                                            @error('image')
                                              <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                          </div>
                                        </div>
                                        <span class="text-muted text-sm pl-2">*Background boleh dikosongkan jika tidak
                                          ingin diubah</span>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="first_text"
                                            class="form-control @error('first_text') is-invalid @enderror"
                                            placeholder="Judul" required value="{{ $homeSlider['first_text'] }}">
                                          @error('first_text')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="second_text"
                                            class="form-control @error('second_text') is-invalid @enderror"
                                            placeholder="Slogan" required value="{{ $homeSlider['second_text'] }}">
                                          @error('second_text')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="third_text"
                                            class="form-control @error('third_text') is-invalid @enderror"
                                            placeholder="Ajakan" required value="{{ $homeSlider['third_text'] }}">
                                          @error('third_text')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <input type="text" name="link" class="form-control" id="link"
                                          placeholder="Link halaman web (jika tidak ada silakan kosongkan)"
                                          value="{{ $homeSlider['link'] }}">
                                      </div>
                                      <div class="form-group">
                                        <select name="is_active" id=""
                                          class="form-control @error('is_active') is-invalid @enderror" required>
                                          <option value="active"
                                            {{ $homeSlider['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                                          <option value="inactive"
                                            {{ $homeSlider['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                        @error('image')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                    </div>
                                    <!-- /.card-body -->
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- modal edit slider --}}

                          <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-slider-delete-{{ $homeSlider['id'] }}">
                            <i class="fas fa-trash"></i>
                          </button>

                          {{-- modal warning hapus slider --}}
                          <div class="modal fade" id="modal-slider-delete-{{ $homeSlider['id'] }}"
                            data-backdrop="static" data-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Hapus Slider</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h3 class="text-center text-danger">Apakah anda yakin ingin menghapus item ini</h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <form action="{{ route('main-settings.destroy', $homeSlider['id']) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- modal warning hapus slider --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- <form action="" method="post" class="text-right mt-2">
                  @csrf
                  <input type="hidden" name="sendArr" id="sendArr" value="">
                  <button type="submit" class="btn btn-primary mx-2 mb-5 px-5" id="simpan">Terapkan</button>
                </form> --}}
              </div>

            </div>
            <!-- /.card -->
          </div>
          {{-- slider utama --}}

          {{-- tiga layanan utama --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Tiga Layanan Utama
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card-body pb-0">
                <div class="row mx-auto">
                  @foreach ($mainServices as $mainService)
                    <div class="d-flex align-items-stretch flex-column mx-auto" style="height: 400px; width: 270px">
                      <div class="card bg-light d-flex flex-fill"
                        style="background: url('{{ asset('images/banner/' . $mainService->image) }}'); background-size: cover;">
                        <div class="card-header text-muted border-bottom-0 text-center"></div>
                        <div class="card-body pt-0 mx-auto">
                          <div class="d-flex flex-column justify-content-center mx-auto">
                            <div class="text-center text-white mt-5"
                              style="text-shadow: -4px 4px 10px rgba(0,0,0,0.6);">
                              <br>
                              <h2>{{ strtoupper($mainService['first_text']) }}</h2>
                              <h5>{{ strtoupper($mainService['second_text']) }}</h5>
                              <h4 class="mb-4">{{ ucwords($mainService['third_text']) }}</h4>
                              <a href="{{ $mainService['link'] }}"
                                class="btn btn-light text-danger rounded-pill">Kunjungi Halaman</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer">
                          <div class="text-right">
                            <a href="#" class="btn btn-sm bg-teal" data-toggle="modal"
                              data-target="#modal-utama-{{ $mainService['id'] }}">
                              <i class="fas fa-edit"></i>
                            </a>

                            {{-- modal edit layanan utama --}}
                            <div class="modal fade" id="modal-utama-{{ $mainService['id'] }}" data-backdrop="static"
                              data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Layanan Utama</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST"
                                      action="{{ route('main-settings.edit-services', $mainService['id']) }}"
                                      enctype="multipart/form-data">
                                      @csrf
                                      @method('PUT')
                                      <div class="card-body">
                                        {{-- <div class="form-group">
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" name="image" class="custom-file-input"
                                                id="exampleInputFile" accept="image/*"
                                                value="{{ $mainService['third_text'] }}">
                                              <label class="custom-file-label text-muted text-left"
                                                for="exampleInputFile">Pilih Background</label>
                                            </div>
                                          </div>
                                        </div> --}}
                                        <div class="row">
                                          <div class="col-sm col-lg-4 col-md-4 mb-3">
                                            <input type="text" name="first_text" class="form-control"
                                              placeholder="Judul" value="{{ $mainService['first_text'] }}" required>
                                          </div>
                                          <div class="col-sm col-lg-4 col-md-4 mb-3">
                                            <input type="text" name="second_text" class="form-control"
                                              placeholder="Middle text" value="{{ $mainService['second_text'] }}"
                                              required>
                                          </div>
                                          <div class="col-sm col-lg-4 col-md-4 mb-3">
                                            <input type="text" name="third_text" class="form-control"
                                              placeholder="Harga" value="{{ $mainService['third_text'] }}" required>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <input type="text" class="form-control" id="link" name="link"
                                            value="{{ $mainService['link'] }}" placeholder="Link halaman web ">
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                      </div>
                                      <!-- /.card-body -->
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            {{-- modal edit layanan utama --}}

                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          {{-- tiga layanan utama --}}

          {{-- elevator pitch --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Elevator Pitch
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">
                    Elevator Pitch Aktif
                  </h3>
                </div>
                <div class="card-body text-center">
                  <h2 class="text-warning">{{ strtoupper($elevatorPitch['title']) }}</h2>
                  <p>{{ $elevatorPitch['content'] }}</p>
                  <button class="mt-4 btn btn-block btn-outline-info" data-toggle="modal"
                    data-target="#modal-ev">Edit</button>
                </div>
                <div class="modal fade" id="modal-ev" data-backdrop="static" data-keyboard="false" tabindex="-1"
                  aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Elevator Pitch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="{{ route('main-settings.edit-ev', $elevatorPitch['id']) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="elevator-pitch">Judul Elevator Pitch</label>
                            <input type="text" name="ev-title"
                              class="form-control @error('ev-title') is-invalid @enderror" id="link"
                              placeholder="Masukkan judul.." required value="{{ $elevatorPitch['title'] }}">
                            @error('ev-title')
                              <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="elevator-pitch">Isi Elevator Pitch</label>
                            <textarea name="ev-desc" class="form-control @error('ev-desc') is-invalid @enderror" id="elevator-pitch"
                              rows="4" required>{{ $elevatorPitch['content'] }}</textarea>
                            @error('ev-desc')
                              <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="elevator-pitch">Judul Elevator Pitch</label>
                    <input type="text" class="form-control" id="link" placeholder="Masukkan judul..">
                  </div>
                  <div class="form-group">
                    <label for="elevator-pitch">Isi Elevator Pitch</label>
                    <textarea class="form-control" id="elevator-pitch" rows="4"></textarea>
                  </div>             
                  <button type="submit" class="btn btn-block btn-primary">Simpan</button>
              </form> --}}
            </div>
            <!-- /.card -->
          </div>
          {{-- elevator pitch --}}

          {{-- services --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Our Services
              </h3>
            </div>
            <div class="p-4">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Tambah Layanan</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" action="{{ route('main-settings.OurService') }}">
                    @csrf
                    <div class="callout callout-info">
                      <h6>Tips Pengguaan Icon Font Awesome</h6>
                      <p class="text-sm">
                        Untuk penggunaan icon font awesome 6 bisa mengunjungi halaman <a class="text-info"
                          href="https://fontawesome.com/search?q=icon&o=r&m=free" target="_blank">font awesome 6</a> dan
                        cari icon sesuai dengan keinginan dan jangan lupa untuk memilih opsi <strong>free</strong> dan
                        apabil icon yang dipilih adalah icon <i>paid</i> maka icon tidak akan muncul
                      </p>
                      <p class="text-sm">
                        Klik icon yang diinginkan kemudian copy
                        <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b>. Setelah di pastekan di form icon
                        font
                        awesome pastikan <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b> diubah menjadi
                        <b>fa-brands fa-accessible-icon</b>
                      </p>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control @error('service_icon') is-invalid @enderror"
                        name="service_icon" placeholder="Font awesome icon...">
                      @error('service_icon')
                        <span class="error invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control @error('service_name') is-invalid @enderror"
                        name="service_name" placeholder="Judul...">
                      @error('service_name')
                        <span class="error invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <select name="service_active" class="form-control @error('service_active') is-invalid @enderror">
                        <option selected disabled>Ditampilkan?</option>
                        <option value="active">Ya</option>
                        <option value="inactive">Tidak</option>
                      </select>
                      @error('service_active')
                        <span class="error invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="card-body pad table-responsive">
              <table id="services" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Servis</th>
                    <th>Ditampilkan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ourServices as $key => $ourService)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $ourService['icon'] }}</td>
                      <td>{{ ucwords($ourService['service_name']) }}</td>
                      <td>                        
                        <select name="select_service[]" class="form-control">
                          <option value="active,{{ $ourService['id'] }}" {{ $ourService['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive,{{ $ourService['id'] }}" {{ $ourService['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </td>
                      <td>
                        <button class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-services-{{ $ourService['id'] }}">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-services-delete-{{ $ourService['id'] }}">
                          <i class="fas fa-trash"></i>
                        </button>
                        {{-- modal edit services --}}
                        <div class="modal fade" id="modal-services-{{ $ourService['id'] }}" data-backdrop="static"
                          data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Layanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST"
                                  action="{{ route('main-settings.edit-our-service', $ourService['id']) }}">
                                  @csrf
                                  @method('PUT')
                                  <div class="callout callout-info">
                                    <h6>Tips Pengguaan Icon Font Awesome</h6>
                                    <p class="text-sm">
                                      Untuk penggunaan icon font awesome 6 bisa mengunjungi halaman <a class="text-info"
                                        href="https://fontawesome.com/search?q=icon&o=r&m=free" target="_blank">font
                                        awesome 6</a> dan cari icon sesuai dengan keinginan dan jangan lupa untuk memilih
                                      opsi <strong>free</strong> dan apabil icon yang dipilih adalah icon <i>paid</i> maka
                                      icon tidak akan muncul
                                    </p>
                                    <p class="text-sm">
                                      Klik icon yang diinginkan kemudian copy
                                      <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b>. Setelah di pastekan di
                                      form icon font awesome pastikan
                                      <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b> diubah menjadi
                                      <b>fa-brands fa-accessible-icon</b>
                                    </p>
                                  </div>
                                  <div class="form-group">
                                    <input type="text"
                                      class="form-control @error('edit_service_icon') is-invalid @enderror"
                                      name="edit_service_icon" value="{{ $ourService['icon'] }}"
                                      placeholder="Font awesome icon...">
                                    @error('edit_service_icon')
                                      <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <input type="text"
                                      class="form-control @error('edit_service_name') is-invalid @enderror"
                                      name="edit_service_name" value="{{ $ourService['service_name'] }}"
                                      placeholder="Judul...">
                                    @error('edit_service_name')
                                      <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <select name="edit_service_active"
                                      class="form-control @error('edit_service_active') is-invalid @enderror">
                                      <option value="active"
                                        {{ $ourService['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                                      <option value="inactive"
                                        {{ $ourService['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('edit_service_active')
                                      <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                                  <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- modal edit services --}}

                        {{-- modal warning hapus services --}}
                        <div class="modal fade" id="modal-services-delete-{{ $ourService['id'] }}"
                          data-backdrop="static" data-keyboard="false" tabindex="-1"
                          aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Layanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h3 class="text-center text-danger">Apakah anda yakin ingin menghapus item ini</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('main-settings.delete-our-service', $ourService['id']) }}"
                                  method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- modal warning hapus services --}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>
          {{-- services --}}

          {{-- 4 slider paket wisata --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Destinasi Wisata Unggulan
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <h4 class="text-center text-primary mb-4">List Semua Destinasi Wisata</h4>
              <table id="wisata" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Ditampilkan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($travels as $key => $travel)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td><img src="{{ asset('images/destination/' . $travel['thumbnail']) }}" alt="img1"
                          width="70px"></td>
                      <td>{{ ucwords($travel['travel_name']) }}</td>
                      <td>
                        <select name="select_wisata[]" class="form-control">
                          <option value="active,{{ $travel['id'] }}" {{ $travel['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive,{{ $travel['id'] }}" {{ $travel['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <button class="btn btn-outline-info btn-block mt-2">Terapkan</button>
            </div>
            <!-- /.card -->
          </div>
          {{-- 4 slider paket wisata --}}

          {{-- oleh-oleh khas batam --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Slider Oleh-oleh
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <h4 class="text-center text-primary mb-4">List Semua Oleh-oleh</h4>
              <table id="suvenir" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Ditampilkan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($suvenirs as $key => $suvenirs)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>
                        <img src="{{ asset('images/suvenirs/' . $suvenirs['thumbnail']) }}"
                          alt="{{ $suvenirs['thumbnail'] }}" width="70px">
                      </td>
                      <td>{{ ucwords($suvenirs['suvenir_name']) }}</td>
                      <td>
                        <select name="select_suvenir[]" class="form-control">
                          <option value="active,{{ $suvenirs['id'] }}"
                            {{ $suvenirs['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive,{{ $suvenirs['id'] }}"
                            {{ $suvenirs['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>
          {{-- oleh-oleh khas batam --}}

          {{-- slider testimoni --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Slider Testimoni
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <h4 class="text-center text-primary mb-4">List Testimoni Pelanggan</h4>
              <table id="testimoni" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Testimoni</th>
                    <th>Ditampilkan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="status_testimoni[]">
                  @foreach ($testimonies as $key => $testimoni)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ ucwords($testimoni['name']) }}</td>
                      <td>{{ $testimoni['email'] }}</td>
                      <td>{{ $testimoni['content'] }}</td>
                      <td>
                        <select class="form-control" name="select_testi[]">
                          <option value="yes,{{ $testimoni['id'] }}"
                            {{ $testimoni['publish'] == 'yes' ? 'selected' : '' }}>Ya</option>
                          <option value="no,{{ $testimoni['id'] }}"
                            {{ $testimoni['publish'] == 'no' ? 'selected' : '' }}>Tidak</option>
                        </select>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-testimoni-delete-{{ $testimoni['id'] }}" title="Hapus">
                          <i class="fas fa-trash"></i>
                        </button>
                        <div class="modal fade" id="modal-testimoni-delete-{{ $testimoni['id'] }}"
                          data-backdrop="static" data-keyboard="false" tabindex="-1"
                          aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Testimoni</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <h3 class="text-center text-danger">Apakah anda yakin ingin menghapus testimoni dari
                                  {{ ucwords($testimoni['name']) }}</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('delete.status-testimoni', $testimoni['id']) }}"
                                  method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{-- <button class="btn btn-outline-info btn-block mt-2">Terapkan</button> --}}
            </div>
            <!-- /.card -->
          </div>
          {{-- slider testimoni --}}

        </div>
        <!-- /.col -->
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection

@push('addon-js')
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  {{-- sweet alert --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('temp-adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    @if ($message = Session::get('success'))
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{!! $message !!}",
      })
    @elseif ($message = Session::get('error'))
      Swal.fire({
        icon: 'error',
        title: 'Opps..',
        text: "{!! $message !!}",
      })
    @endif

    $(document).ready(function() {
      $('#example').DataTable({
        order: [
          [0, 'asc']
        ],
      });
      $('#services').DataTable({
        order: [
          [3, 'desc']
        ],
      });
      $('#wisata').DataTable({
        order: [
          [3, 'desc']
        ],
      });
      $('#suvenir').DataTable({
        order: [
          [3, 'desc']
        ],
      });
      $('#testimoni').DataTable({
        order: [
          [3, 'desc']
        ],
      });

      bsCustomFileInput.init();
    });

    let changeStatus = (elem, gurl) => {
      for (let a = 0; a < elem.length; a++) {
        elem.eq(a).on('change', (e) => {

          let elemVal = elem.eq(a).val()
          elemVal = elemVal.split(",")

          let getId = elemVal[elemVal.length - 1]

          let url = gurl + getId

          $.ajaxSetup({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
          });

          let csrf_token = $('meta[name="_token"]').attr("content")

          $.ajax({
            url: url,
            type: 'POST',
            data: {
              _method: "PUT",
              _token: csrf_token,
              id: getId,
              publish: elemVal[0],
            },
            success: function(data) {
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
              })
            },
            error: function(data) {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.responseJSON.error,
              })
            },
          })
        })
      }
    }

    // ajax testimoni 
    let testiElement = $('select[name="select_testi[]"]')
    let origin = window.location.origin
    let target = origin + '/admin/satatus-testimoni/'
    changeStatus(testiElement, target)    

    // ajax oleh-oleh
    let suvenirElement = $('select[name="select_suvenir[]"]')
    for (let b = 0; b < suvenirElement.length; b++) {
      suvenirElement.eq(b).on('change', (e) => {
        console.log(suvenirElement.eq(b).val())

        let elemVal = suvenirElement.eq(b).val()
        elemVal = elemVal.split(",")

        let origin = window.location.origin
        let getId = elemVal[elemVal.length - 1]

        let url = origin +
          '/admin/satatus-suvenir/' + getId

        $.ajaxSetup({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        });

        let csrf_token = $('meta[name="_token"]').attr("content")

        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _method: "PUT",
            _token: csrf_token,
            id: getId,
            is_active: elemVal[0],
          },
          success: function(data) {
            // console.log(data);
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: data.message,
            })
          },
          error: function(data) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: data.responseJSON.error,
            })
          },
        })
      })
    }

    // ajax wisata
    let wisataElement = $('select[name="select_wisata[]"]')
    let targetWisata = origin + '/admin/satatus-wisata/'
    changeStatus(wisataElement, targetWisata)
    
    // ajax service
    let serviceElement = $('select[name="select_service[]"]')
    let targetService = origin + '/admin/satatus-service/'
    changeStatus(serviceElement, targetService)

    // ajax slider
    let sliderElement = $('select[name="select_slider[]"]')
    let targetSlider = origin + '/admin/satatus-slider/'
    changeStatus(sliderElement, targetSlider)
  </script>
@endpush

@push('addon-css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush
