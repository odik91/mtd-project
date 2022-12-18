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
                  <form method="POST" action="{{ route('oleh-oleh.store') }}">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                          value="{{ old('name') }}" placeholder="Masukkan nama kategori">
                        @error('name')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
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
                    @foreach ($suvenirs as $key => $suvenir)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ ucwords($suvenir['name']) }}</td>
                        <td>
                          <button class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-category-{{ $suvenir['id'] }}" title="edit destinasi">
                            <i class="fas fa-edit"></i>
                          </button>

                          <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-category-delete-{{ $suvenir['id'] }}" title="hapus destinasi">
                            <i class="fas fa-trash"></i>
                          </button>
                          {{-- modal edit category --}}
                          <div class="modal fade" id="modal-category-{{ $suvenir['id'] }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori Oleh-oleh</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{ route('oleh-oleh.update', $suvenir['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                      <div class="form-group">
                                        <input name="edit_name" type="text"
                                          class="form-control @error('edit_name') is-invalid @enderror"
                                          value="{{ $suvenir['name'] }}" placeholder="Masukkan nama kategori">
                                        @error('edit_name')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- modal edit category --}}

                          {{-- modal warning hapus category --}}
                          <div class="modal fade" id="modal-category-delete-{{ $suvenir['id'] }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                  <form action="{{ route('oleh-oleh.destroy', $suvenir['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- modal warning hapus category --}}
                        </td>
                      </tr>
                    @endforeach
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
                  <form method="POST" enctype="multipart/form-data" action="{{ route('oleh-oleh.add-item') }}">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="suvenir_name"
                            class="form-control @error('suvenir_name') is-invalid @enderror"
                            placeholder="Nama Oleh-oleh" value="{{ old('suvenir_name') }}" required>
                          @error('suvenir_name')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="first_text"
                            class="form-control @error('first_text') is-invalid @enderror" placeholder="Middle Text"
                            value="{{ old('first_text') }}" required>
                          @error('first_text')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="start_price"
                            class="form-control @error('start_price') is-invalid @enderror" placeholder="Bottom Text"
                            value="{{ old('start_price') }}" required>
                          @error('start_price')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <select name="suvenir_category_id"
                          class="form-control @error('suvenir_category_id') is-invalid @enderror" required>
                          <option {{ !old('suvenir_category_id') ? 'selected' : '' }} disabled>Pilih Kategori</option>
                          @foreach ($suvenirs as $suvenir)
                            <option value="{{ $suvenir['id'] }}"
                              {{ old('suvenir_category_id') == $suvenir['id'] ? 'selected' : '' }}>
                              {{ ucwords($suvenir['name']) }}</option>
                          @endforeach
                        </select>
                        @error('suvenir_category_id')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file"
                              class="custom-file-input @error('suvenir_category_id') is-invalid @enderror"
                              name="thumbnail" id="thumnail-01" accept="image/*" name="thumbnail" required>
                            <label class="custom-file-label text-muted" for="thumnail-01">Pilih Gambar Thumnail untuk
                              Siler</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image"
                              class="custom-file-input @error('image') is-invalid @enderror" id="img-liting"
                              accept="image/*" required>
                            <label class="custom-file-label text-muted" for="img-liting">Pilih Gambar untuk
                              Listing</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea id="package-description" name="suvenir_description"
                          class="@error('suvenir_description') is-invalid @enderror" required>{{ old('suvenir_description') }}</textarea>
                        @error('suvenir_description')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <select name="suvenir_active" class="form-control @error('suvenir_active') is-invalid @enderror"
                          required>
                          <option {{ !old('suvenir_active') ? 'selected' : '' }} disabled>Aktif?</option>
                          <option value="active" {{ old('suvenir_active') == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive" {{ old('suvenir_active') == 'inactive' ? 'selected' : '' }}>Tidak
                          </option>
                        </select>
                        @error('suvenir_active')
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
                <h4 class="text-center mb-2 text-primary">Daftar Oleh-oleh</h4>
                <br>
                <table id="package-list" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Oleh-oleh</th>
                      <th>Kategori</th>
                      <th>Middle Text</th>
                      <th>Bottom Text</th>
                      <th>Thumbnail</th>
                      <th>Image</th>
                      <th>Deskripsi</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($listSuvenirs as $key => $listSuvenir)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ ucwords($listSuvenir['suvenir_name']) }}</td>
                        <td>{{ ucwords($listSuvenir->getCategorySuvenir['name']) }}</td>
                        <td>{{ ucwords($listSuvenir['first_text']) }}</td>
                        <td>{{ ucwords($listSuvenir['start_price']) }}</td>
                        <td>
                          <img src="{{ asset('images/suvenirs/' . $listSuvenir['thumbnail']) }}" alt="{{ $listSuvenir['thumbnail'] }}"
                            width="70px">
                        </td>
                        <td>
                          <img src="{{ asset('images/suvenirs/' . $listSuvenir['image']) }}" alt="{{ $listSuvenir['image'] }}"
                            width="70px">
                        </td>
                        <td>
                          {!! strip_tags(substr($listSuvenir['description'], 0, 100)) !!}...
                        </td>
                        <td>
                          {{ $listSuvenir['is_active'] == 'active' ? 'Ya' : 'Tidak' }}
                          {{-- <select name="" id="" class="form-control">
                            <option value="active" selected>Ya</option>
                            <option value="active" selected>Tidak</option>
                          </select> --}}
                        </td>
                        <td>
                          <button class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-package-{{ $listSuvenir['id'] }}" title="edit oleh-oleh">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-package-delete-{{ $listSuvenir['id'] }}" title="hapus oleh-oleh">
                            <i class="fas fa-trash"></i>
                          </button>
                          {{-- modal edit package --}}
                          <div class="modal fade" id="modal-package-{{ $listSuvenir['id'] }}" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Oleh-oleh</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" enctype="multipart/form-data" action="{{ route('oleh-oleh.edit-item', $listSuvenir['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_suvenir_name"
                                            class="form-control @error('edit_suvenir_name') is-invalid @enderror"
                                            placeholder="Nama Oleh-oleh" value="{{ $listSuvenir['suvenir_name'] }}" required>
                                          @error('edit_suvenir_name')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_first_text"
                                            class="form-control @error('edit_first_text') is-invalid @enderror" placeholder="Middle Text"
                                            value="{{ $listSuvenir['first_text'] }}" required>
                                          @error('edit_first_text')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_start_price"
                                            class="form-control @error('edit_start_price') is-invalid @enderror" placeholder="Bottom Text"
                                            value="{{ $listSuvenir['start_price'] }}" required>
                                          @error('edit_start_price')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <select name="edit_suvenir_category_id"
                                          class="form-control @error('edit_suvenir_category_id') is-invalid @enderror" required>
                                          @foreach ($suvenirs as $suvenir)
                                            <option value="{{ $suvenir['id'] }}"
                                              {{ $suvenir['id'] == $listSuvenir['suvenir_category_id'] ? 'selected' : '' }}>
                                              {{ ucwords($suvenir['name']) }}</option>
                                          @endforeach
                                        </select>
                                        @error('edit_suvenir_category_id')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file"
                                              class="custom-file-input @error('edit_thumbnail') is-invalid @enderror"
                                              name="edit_thumbnail" id="thumnail-01" accept="image/*" name="edit_thumbnail">
                                            <label class="custom-file-label text-muted" for="thumnail-01">Pilih Gambar Thumnail untuk
                                              Siler</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" name="edit_image"
                                              class="custom-file-input @error('edit_image') is-invalid @enderror" id="img-liting"
                                              accept="image/*">
                                            <label class="custom-file-label text-muted" for="img-liting">Pilih Gambar untuk
                                              Listing</label>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <textarea id="package-description-edit-{{ $listSuvenir['id'] }}" name="edit_suvenir_description"
                                          class="@error('edit_suvenir_description') is-invalid @enderror" required>{{ $listSuvenir['description'] }}</textarea>
                                        @error('edit_suvenir_description')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <select name="edit_suvenir_active" class="form-control @error('edit_suvenir_active') is-invalid @enderror"
                                          required>
                                          <option value="active" {{ $listSuvenir['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                                          <option value="inactive" {{ $listSuvenir['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak
                                          </option>
                                        </select>
                                        @error('edit_suvenir_active')
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
                          {{-- modal edit package --}}

                          {{-- modal warning hapus package --}}
                          <div class="modal fade" id="modal-package-delete-{{ $listSuvenir['id'] }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Hapus Oleh-oleh</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h3 class="text-center text-danger">Apakah anda yakin ingin menghapus item ini</h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <form action="{{ route('oleh-oleh.delete-item', $listSuvenir['id']) }}" method="POST">
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
  {{-- sweet alert --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('temp-adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('temp-adm/plugins/summernote/summernote-bs4.min.js') }}"></script>
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

      @foreach ($listSuvenirs as $listSuvenir)
        $("#package-description-edit-{{$listSuvenir->id}}").summernote({
          placeholder: 'Detail informasi paket wisata...',
          tabsize: summernote_tabsize,
          height: summernote_height,
          toolbar: summernote_toolbar,
          popover: summernote_popover
        })
      @endforeach
      
    })

    $(document).ready(function() {

      bsCustomFileInput.init();

      $('#example').DataTable({
        order: [
          [0, 'asc']
        ],
      });
      $('#package-list').DataTable({
        order: [
          [0, 'asc']
        ],
      });
    });
  </script>
@endpush
