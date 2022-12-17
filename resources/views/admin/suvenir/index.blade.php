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
          {{-- categori oleh-oleh --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Kategori Oleh-oleh
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Kategori Oleh-oleh</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="card-body">
                      <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Masukkan nama kategori">
                      </div>
                      <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <hr>
              <div class="p-4">
                <h4 class="text-center mb-2 text-primary">Daftar Kategori Oleh-oleh</h4>
                <br>
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>fsdfd</td>
                      <td>

                        <a href="#" class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-slider-1" title="edit destinasi">
                          <i class="fas fa-edit"></i>
                        </a>

                        <a href="#" class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-slider-delete-1" title="hapus destinasi">
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
                                      <input name="name" type="text" class="form-control"
                                        placeholder="Masukkan nama kategori">
                                    </div>
                                    <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- modal edit slider --}}

                        {{-- modal warning hapus slider --}}
                        <div class="modal fade" id="modal-slider-delete-1" data-backdrop="static" data-keyboard="false"
                          tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Kategori Oleh-oleh</h5>
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
          {{-- categori oleh-oleh --}}

          {{-- oelh-oleh --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Oleh-oleh
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Tambah Oleh-oleh</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumnail-01" accept="image/*" name="thumbnail">
                            <label class="custom-file-label text-muted" for="thumnail-01">Pilih Gambar Thumnail untuk Siler</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="img-liting">
                            <label class="custom-file-label text-muted" for="img-liting">Pilih Gambar untuk Listing</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <select name="suvenir_category_id" class="form-control">
                          <option selected disabled>Pilih Kategori</option>
                          <option value="">Kategori 1</option>
                          <option value="">Kategori 2</option>
                          <option value="">Kategori 3</option>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Nama Oleh-oleh">
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Middle Text">
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" class="form-control" placeholder="Bottom Text">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea id="package-description"></textarea>
                      </div>
                      <div class="form-group">
                        <select name="active" id="" class="form-control">
                          <option selected disabled>Aktif?</option>
                          <option value="active">Ya</option>
                          <option value="inactive">Tidak</option>
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
                <h4 class="text-center mb-2 text-primary">Daftar Paket Wisata</h4>
                <br>
                <table id="package-list" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Destinasi</th>
                      <th>Nama Paket</th>
                      <th>Middle Text</th>
                      <th>Bottom Text</th>
                      <th>Deskripsi</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>asdfs</td>
                      <td>fsdfs</td>
                      <td>fsdfd</td>
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
                          data-target="#modal-package-1" title="edit paket">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                          data-target="#modal-package-delete-1" title="hapus paket">
                          <i class="fas fa-trash"></i>
                        </a>
                        {{-- modal edit package --}}
                        <div class="modal fade" id="modal-package-1" data-backdrop="static" data-keyboard="false"
                          tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Paket</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="card-body">
                                    <div class="form-group">
                                      <select name="" class="form-control">
                                        <option selected disabled>Pilih Destinasi</option>
                                        <option value="">Destinasi 1</option>
                                        <option value="">Destinasi 2</option>
                                        <option value="">Destinasi 3</option>
                                      </select>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Paket">
                                      </div>
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Middle Text">
                                      </div>
                                      <div class="col-sm col-lg-4 col-md-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Bottom Text">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <textarea id="package-description-edit"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <select name="active" id="" class="form-control">
                                        <option selected disabled>Aktif?</option>
                                        <option value="active">Ya</option>
                                        <option value="inactive">Tidak</option>
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
                        {{-- modal edit package --}}

                        {{-- modal warning hapus package --}}
                        <div class="modal fade" id="modal-package-delete-1" data-backdrop="static"
                          data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Hapus Paket</h5>
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
          {{-- oelh-oleh --}}

        </div>
        <!-- /.col -->
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection

@push('addon-css')
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('temp-adm/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@push('addon-js')
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <!-- Summernote -->
  <script src="{{ asset('temp-adm/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    $(function() {
      // Summernote
      const summernote_tabsize = 2;
      const summernote_height = 400;
      const summernote_toolbar = [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['insert', ['link', 'picture', 'hr', 'video']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ];
      const summernote_popover = {
        image: [
          ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
          ['float', ['floatLeft', 'floatRight', 'floatNone']],
          ['remove', ['removeMedia']]
        ],
        link: [
          ['link', ['linkDialogShow', 'unlink']]
        ],
        air: [
          ['color', ['color']],
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'paragraph']],
          ['insert', ['link', 'picture']]
        ]
      }
      $('#summernote').summernote({
        placeholder: 'Detail informasi destinasi...',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar,
        popover: summernote_popover
      })
      $('#package-description').summernote({
        placeholder: 'Detail informasi oleh-oleh',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar,
        popover: summernote_popover
      })
      $('#package-description-edit').summernote({
        placeholder: 'Detail informasi paket wisata...',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar,
        popover: summernote_popover
      })
    })

    $(document).ready(function() {
      $('#example').DataTable({
        order: [
          [0, 'desc']
        ],
      });
      $('#package-list').DataTable({
        order: [
          [3, 'desc']
        ],
      });
    });
  </script>
@endpush
