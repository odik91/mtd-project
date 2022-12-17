@extends('admin.layouts.master')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaturan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
            <li class="breadcrumb-item active">Halaman Utama</li>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label text-muted" for="exampleInputFile">Pilih Background</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Judul">
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Slogan">
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Ajakan">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="link" placeholder="Link halaman web ">
                      </div>
                      <div class="form-group">
                        <select name="active" id="" class="form-control">
                          <option selected disabled>Ditampilkan?</option>
                          <option value="active">Aktif</option>
                          <option value="inactive">Tidak Aktif</option>
                        </select>
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
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <img src="{{ asset('template/images/slide.jpg') }}" alt="img1" width="70px">
                      </td>
                      <td>asdfs</td>
                      <td>fsdfs</td>
                      <td>fsdfd</td>
                      <td>fsdfd</td>
                      <td>
                        <select name="" id="" class="form-control">
                          <option value="active" selected>Ya</option>
                          <option value="active" selected>Tidak</option>
                        </select>
                      </td>
                      <td>
                        <a href="#" class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-slider-1">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-slider-delete-1">
                          <i class="fas fa-trash"></i>
                        </a>
                        {{-- modal edit slider --}}
                        <div class="modal fade" id="modal-slider-1" data-backdrop="static" data-keyboard="false"
                          tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Slider</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="exampleInputFile">
                                          <label class="custom-file-label text-muted" for="exampleInputFile">Pilih
                                            Background</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Judul">
                                      </div>
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Slogan">
                                      </div>
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Ajakan">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" class="form-control" id="link"
                                        placeholder="Link halaman web ">
                                    </div>
                                    <div class="form-group">
                                      <select name="active" id="" class="form-control">
                                        <option selected disabled>Ditampilkan?</option>
                                        <option value="active">Aktif</option>
                                        <option value="inactive">Tidak Aktif</option>
                                      </select>
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

                        {{-- modal warning hapus slider --}}
                        <div class="modal fade" id="modal-slider-delete-1" data-backdrop="static"
                          data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                          aria-hidden="true">
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
                                <button type="submit" class="btn btn-danger">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- modal warning hapus slider --}}
                      </td>
                    </tr>
                  </tbody>
                </table>
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
                  <div class="d-flex align-items-stretch flex-column mx-auto" style="height: 400px; width: 270px">
                    <div class="card bg-light d-flex flex-fill"
                      style="background: url('{{ asset('template/images/ban_img1.jpg') }}'); background-size: cover;">
                      <div class="card-header text-muted border-bottom-0 text-center"></div>
                      <div class="card-body pt-0 mx-auto">
                        <div class="d-flex flex-column justify-content-center mx-auto">
                          <div class="text-center text-white mt-5">
                            <br>
                            <h1>BARCELONA</h1>
                            <h4>MULAI DARI</h4>
                            <h3 class="mb-4">Rp.8 Juta</h3>
                            <a href="#" class="btn btn-light text-danger rounded-pill">Kunjungi Halaman</a>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <a href="#" class="btn btn-sm bg-teal" data-toggle="modal"
                            data-target="#modal-utama-1">
                            <i class="fas fa-edit"></i>
                          </a>

                          {{-- modal edit layanan utama --}}
                          <div class="modal fade" id="modal-utama-1" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Layanan Utama</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form>
                                    <div class="card-body">
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label text-muted text-left  "
                                              for="exampleInputFile">Pilih Background</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" class="form-control" placeholder="Judul">
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" class="form-control" placeholder="Middle text">
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" class="form-control" placeholder="Harga">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <input type="text" class="form-control" id="link"
                                          placeholder="Link halaman web ">
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
                  <div class="d-flex align-items-stretch flex-column mx-auto" style="height: 400px; width: 270px">
                    <div class="card bg-light d-flex flex-fill"
                      style="background: url('{{ asset('template/images/ban_img1.jpg') }}'); background-size: cover;">
                      <div class="card-header text-muted border-bottom-0 text-center"></div>
                      <div class="card-body pt-0 mx-auto">
                        <div class="d-flex flex-column justify-content-center mx-auto">
                          <div class="text-center text-white mt-5">
                            <br>
                            <h1>BARCELONA</h1>
                            <h4>MULAI DARI</h4>
                            <h3 class="mb-4">Rp.8 Juta</h3>
                            <a href="#" class="btn btn-light text-danger rounded-pill">Kunjungi Halaman</a>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <a href="#" class="btn btn-sm bg-teal">
                            <i class="fas fa-edit"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex align-items-stretch flex-column mx-auto" style="height: 400px; width: 270px">
                    <div class="card bg-light d-flex flex-fill"
                      style="background: url('{{ asset('template/images/ban_img1.jpg') }}'); background-size: cover;">
                      <div class="card-header text-muted border-bottom-0 text-center"></div>
                      <div class="card-body pt-0 mx-auto">
                        <div class="d-flex flex-column justify-content-center mx-auto">
                          <div class="text-center text-white mt-5">
                            <br>
                            <h1>BARCELONA</h1>
                            <h4>MULAI DARI</h4>
                            <h3 class="mb-4">Rp.8 Juta</h3>
                            <a href="#" class="btn btn-light text-danger rounded-pill">Kunjungi Halaman</a>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <a href="#" class="btn btn-sm bg-teal">
                            <i class="fas fa-edit"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
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
                  <h2 class="text-warning">MAMAE TIRTA DEWATA TOUR & TRAVEL</h2>
                  <p>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum."
                  </p>
                  <a href="#" class="mt-4 btn btn-block btn-outline-info" data-toggle="modal"
                    data-target="#modal-ev">Edit</a>
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
                      <form>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="elevator-pitch">Judul Elevator Pitch</label>
                            <input type="text" class="form-control" id="link" placeholder="Masukkan judul..">
                          </div>
                          <div class="form-group">
                            <label for="elevator-pitch">Isi Elevator Pitch</label>
                            <textarea class="form-control" id="elevator-pitch" rows="4"></textarea>
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
                  <form>
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
                        <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b>. Setelah di pastekan di form icon font
                        awesome pastikan <b>{{ "<i class='fa-brands fa-accessible-icon'></i>" }}</b> diubah menjadi
                        <b>fa-brands fa-accessible-icon</b>
                      </p>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="link" placeholder="Font awesome icon...">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="link" placeholder="Judul...">
                    </div>
                    <div class="form-group">
                      <select name="active" id="" class="form-control">
                        <option selected disabled>Ditampilkan?</option>
                        <option value="active">Ya</option>
                        <option value="inactive">Tidak</option>
                      </select>
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
                  <tr>
                    <td>1</td>
                    <td>fa-brands fa-accessible-icon</td>
                    <td>Tiket Pesawat</td>
                    <td>
                      <select name="" id="" class="form-control">
                        <option value="active" selected>Ya</option>
                        <option value="active" selected>Tidak</option>
                      </select>
                    </td>
                    <td>
                      <a href="#" class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                        data-target="#modal-services-1">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                        data-target="#modal-services-delete-1">
                        <i class="fas fa-trash"></i>
                      </a>
                      {{-- modal edit services --}}
                      <div class="modal fade" id="modal-services-1" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Edit Layanan</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form>
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
                                  <input type="text" class="form-control" id="link"
                                    placeholder="Font awesome icon...">
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="link" placeholder="Judul...">
                                </div>
                                <div class="form-group">
                                  <select name="active" id="" class="form-control">
                                    <option selected disabled>Ditampilkan?</option>
                                    <option value="active">Ya</option>
                                    <option value="inactive">Tidak</option>
                                  </select>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                <!-- /.card-body -->
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- modal edit services --}}

                      {{-- modal warning hapus services --}}
                      <div class="modal fade" id="modal-services-delete-1" data-backdrop="static"
                        data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                              <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- modal warning hapus services --}}
                    </td>
                  </tr>
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
                Paket Wisata Unggulan
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <h4 class="text-center text-primary mb-4">List Semua Paket Wisata</h4>
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
                  <tr>
                    <td>1</td>
                    <td><img src="{{ asset('template/images/slide.jpg') }}" alt="img1" width="70px"></td>
                    <td>Test</td>
                    <td>
                      <select name="" id="" class="form-control">
                        <option value="active" selected>Ya</option>
                        <option value="active" selected>Tidak</option>
                      </select>
                    </td>
                  </tr>
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
                  <tr>
                    <td>1</td>
                    <td><img src="{{ asset('template/images/slide.jpg') }}" alt="img1" width="70px"></td>
                    <td>Test</td>
                    <td>
                      <select name="" id="" class="form-control">
                        <option value="active" selected>Ya</option>
                        <option value="active" selected>Tidak</option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button class="btn btn-outline-info btn-block mt-2">Terapkan</button>
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
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Testimoni</th>
                    <th>Ditampilkan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><img src="{{ asset('template/images/slide.jpg') }}" alt="img1" width="70px"></td>
                    <td>User 1</td>
                    <td>Lorem ipsum dolor</td>
                    <td>
                      <select name="" id="" class="form-control">
                        <option value="active" selected>Ya</option>
                        <option value="active" selected>Tidak</option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button class="btn btn-outline-info btn-block mt-2">Terapkan</button>
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
  <script>
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    $(document).ready(function() {
      $('#example').DataTable({
        order: [
          [3, 'desc']
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
    });
  </script>
@endpush

@push('addon-css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush
