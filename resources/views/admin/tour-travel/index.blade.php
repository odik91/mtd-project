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
          {{-- destinasi wisata --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Destinasi Wisata
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Tambah Destinasi Wisata</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" action="{{ route('tour-travel.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="travel_name"
                            class="form-control @error('travel_name') is-invalid @enderror" placeholder="Destinasi"
                            value="{{ old('travel_name') }}" required>
                          @error('travel_name')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="second_text"
                            class="form-control @error('second_text') is-invalid @enderror" placeholder="Middle Text"
                            value="{{ old('second_text') }}" required>
                          @error('second_text')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="start_price"
                            class="form-control @error('start_price') is-invalid @enderror" placeholder="Harga mulai..."
                            value="{{ old('start_price') }}" required>
                          @error('start_price')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
                            placeholder="Negara tujuan..." value="{{ old('country') }}" required>
                          @error('country')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="region" class="form-control @error('region') is-invalid @enderror"
                            placeholder="Daerah tujuan.." value="{{ old('region') }}" required>
                          @error('region')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror"
                              id="thumbnail" name="thumbnail" accept="image/*" value="{{ old('thumbnail') }}" required>
                            <label class="custom-file-label text-muted" for="thumbnail">Pilih Thumbnail</label>
                          </div>
                          @error('thumbnail')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                              value="{{ old('image') }}" id="image" name="image" accept="image/*" required>
                            <label class="custom-file-label text-muted" for="image">Pilih Gambar</label>
                          </div>
                          @error('image')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea id="summernote" name="description" class="@error('description') is-invalid @enderror" required></textarea>
                        @error('description')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                          <option selected disabled>Ditampilkan?</option>
                          <option value="active">Ya</option>
                          <option value="inactive">Tidak</option>
                        </select>
                        @error('is_active')
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
                <h4 class="text-center mb-2 text-primary">Daftar Destinasi Wisata</h4>
                <br>
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Wisata</th>
                      <th>Middle Text</th>
                      <th>Harrga Mulai</th>
                      <th>Negara Tujuan</th>
                      <th>Daerah Tujuan</th>
                      <th>Thumbnail</th>
                      <th>Gambar</th>
                      <th>Deskripsi</th>
                      <th>Total Paket</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($travels as $key => $travel)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ ucwords($travel['travel_name']) }}</td>
                        <td>{{ ucwords($travel['second_text']) }}</td>
                        <td>{{ ucwords($travel['start_price']) }}</td>
                        <td>{{ ucwords($travel['country']) }}</td>
                        <td>{{ ucwords($travel['region']) }}</td>
                        <td>
                          <img src="{{ asset('images/destination/' . $travel['thumbnail']) }}" alt="img1"
                            width="70px">
                        </td>
                        <td>
                          <img src="{{ asset('images/destination/' . $travel['image']) }}" alt="img1"
                            width="70px">
                        </td>
                        <td>{!! strip_tags(substr($travel['description'], 0, 100)) !!}...</td>
                        <td>0</td>
                        <td>
                          {{ $travel['is_active'] == 'active' ? 'Ya' : 'Tidak' }}
                          {{-- <select name="" id="" class="form-control">
                          <option value="active" selected>Ya</option>
                          <option value="active" selected>Tidak</option>
                        </select> --}}
                        </td>
                        <td>
                          <a href="#" class="btn btn-sm btn-info m-1" style="width: 35px" title="tambah paket"
                            data-toggle="modal" data-target="#modal-direct-add-package">
                            <i class="fa fa-plus"></i>
                          </a>

                          <a href="#" class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-travel-edit-{{ $travel['id'] }}" title="edit destinasi">
                            <i class="fas fa-edit"></i>
                          </a>

                          <a href="#" class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-slider-delete-1" title="hapus destinasi">
                            <i class="fas fa-trash"></i>
                          </a>

                          {{-- modal edit travel --}}
                          <div class="modal fade" id="modal-travel-edit-{{ $travel['id'] }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Edit Tour</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{ route('tour-travel.update', $travel['id']) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_travel_name"
                                            class="form-control @error('edit_travel_name') is-invalid @enderror"
                                            placeholder="Destinasi" value="{{ $travel['travel_name'] }}" required>
                                          @error('edit_travel_name')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_second_text"
                                            class="form-control @error('edit_second_text') is-invalid @enderror"
                                            placeholder="Middle Text..." value="{{ $travel['second_text'] }}" required>
                                          @error('edit_second_text')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                                          <input type="text" name="edit_start_price"
                                            class="form-control @error('edit_start_price') is-invalid @enderror"
                                            placeholder="Harga mulai..." value="{{ $travel['start_price'] }}" required>
                                          @error('edit_start_price')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                                          <input type="text" name="edit_country"
                                            class="form-control @error('edit_country') is-invalid @enderror"
                                            placeholder="Negara tujuan..." value="{{ $travel['country'] }}" required>
                                          @error('edit_country')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                                          <input type="text" name="edit_region"
                                            class="form-control @error('edit_region') is-invalid @enderror"
                                            placeholder="Daerah tujuan.." value="{{ $travel['region'] }}" required>
                                          @error('edit_region')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file"
                                              class="custom-file-input @error('edit_thumbnail') is-invalid @enderror"
                                              id="edit_thumbnail" name="edit_thumbnail" accept="image/*"
                                              value="{{ $travel['thumbnail'] }}">
                                            <label class="custom-file-label text-muted" for="edit_thumbnail">Pilih
                                              Thumbnail</label>
                                          </div>
                                          @error('edit_thumbnail')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file"
                                              class="custom-file-input @error('edit_image') is-invalid @enderror"
                                              value="{{ $travel['image'] }}" id="edit_image" name="edit_image"
                                              accept="image/*">
                                            <label class="custom-file-label text-muted" for="edit_image">Pilih
                                              Gambar</label>
                                          </div>
                                          @error('image')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <textarea id="summernote-{{ $travel['id'] }}" name="edit_description"
                                          class="@error('edit_description') is-invalid @enderror" required>
                                          {{ $travel['description'] }}
                                        </textarea>
                                        @error('edit_description')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <select name="edit_is_active"
                                          class="form-control @error('edit_is_active') is-invalid @enderror" required>
                                          <option value="active"
                                            {{ $travel['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                                          <option value="inactive"
                                            {{ $travel['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                        @error('edit_is_active')
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
                          {{-- modal edit travel --}}

                          {{-- modal warning hapus slider --}}
                          <div class="modal fade" id="modal-slider-delete-1" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Hapus Destinasi Wisata</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <h3 class="text-center text-danger">Apakah anda yakin ingin menghapus item ini</h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <form action="{{ route('tour-travel.destroy', $travel['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          {{-- modal warning hapus slider --}}

                          {{-- modal tambah paket direct --}}
                          <div class="modal fade" id="modal-direct-add-package" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Tambah paket</h5>
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
                                        <textarea id="package-description-direct"></textarea>
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
                          {{-- modal tambah paket direct --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.card -->
          </div>
          {{-- destinasi wisata --}}

          {{-- paket wisata --}}
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Paket Wisata
              </h3>
            </div>
            <div class="card-body pad table-responsive">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title text-center">Tambah Paket Wisata</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form method="POST" action="{{ route('tour-travel.add-package') }}">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <select name="travel_id" class="form-control @error('travel_id') is-invalid @enderror"
                          required>
                          <option {{ old('travel_id') ? '' : 'selected' }} disabled>Pilih Destinasi</option>
                          @foreach ($selectTravels as $key => $selectTravel)
                            <option value="{{ $selectTravel['id'] }}"
                              {{ old('travel_id') == $selectTravel['id'] ? 'selected' : '' }}>
                              {{ ucwords($selectTravel['travel_name']) }}</option>
                          @endforeach
                        </select>
                        @error('travel_id')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="package_name"
                            class="form-control @error('package_name') is-invalid @enderror" placeholder="Nama Paket"
                            value="{{ old('package_name') }}" required>
                          @error('package_name')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" class="form-control @error('package_price') is-invalid @enderror"
                            name="package_price" placeholder="Harga" value="{{ old('package_price') }}" required>
                          @error('package_price')
                            <span class="error invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea id="package_description" name="package_description"
                          class="@error('package_description') is-invalid @enderror" required>{{ old('package_description') }}</textarea>
                        @error('package_description')
                          <span class="error invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <select name="package_active"
                          class="form-control @error('package_active') is-invalid @enderror" required>
                          <option {{ !old('package_active') ? 'selected' : '' }} disabled>Aktif?</option>
                          <option value="active" {{ old('package_active') == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive" {{ old('package_active') == 'inactive' ? 'selected' : '' }}>Tidak
                          </option>
                        </select>
                        @error('package_active')
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
                <h4 class="text-center mb-2 text-primary">Daftar Paket Wisata</h4>
                <br>
                <table id="package-list" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Destinasi</th>
                      <th>Nama Paket</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($travelPackages as $key => $travelPackage)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ ucwords($travelPackage->getDestination['travel_name']) }}</td>
                        <td>{{ ucwords($travelPackage['package_name']) }}</td>
                        <td>{{ $travelPackage['price'] }}</td>
                        <td>{!! strip_tags(substr($travelPackage['description'], 0, 100)) !!}...</td>
                        <td>
                          {{ $travelPackage['is_active'] == 'active' ? 'Ya' : 'Tidak' }}
                          {{-- <select name="" id="" class="form-control">
                            <option value="active" selected>Ya</option>
                            <option value="active" selected>Tidak</option>
                          </select> --}}
                        </td>
                        <td>
                          <button class="btn btn-sm bg-teal m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-package-{{ $travelPackage['id'] }}" title="edit paket">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger m-1" style="width: 35px" data-toggle="modal"
                            data-target="#modal-package-delete-{{ $travelPackage['id'] }}" title="hapus paket">
                            <i class="fas fa-trash"></i>
                          </button>
                          {{-- modal edit package --}}
                          <div class="modal fade" id="modal-package-{{ $travelPackage['id'] }}" data-backdrop="static" data-keyboard="false"
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
                                  <form method="POST" action="{{ route('tour-travel.edit-package', $travelPackage['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                      <div class="form-group">
                                        <select name="edit_travel_id" class="form-control @error('edit_travel_id') is-invalid @enderror"
                                          required>
                                          @foreach ($selectTravels as $key => $selectTravel)
                                            <option value="{{ $selectTravel['id'] }}"
                                              {{ $travelPackage['travel_id'] == $selectTravel['id'] ? 'selected' : '' }}>
                                              {{ ucwords($selectTravel['travel_name']) }}</option>
                                          @endforeach
                                        </select>
                                        @error('edit_travel_id')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <div class="row">
                                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                                          <input type="text" name="edit_package_name"
                                            class="form-control @error('edit_package_name') is-invalid @enderror" placeholder="Nama Paket"
                                            value="{{ $travelPackage['package_name'] }}" required>
                                          @error('edit_package_name')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                                          <input type="text" class="form-control @error('edit_package_price') is-invalid @enderror"
                                            name="edit_package_price" placeholder="Harga" value="{{ $travelPackage['price'] }}" required>
                                          @error('edit_package_price')
                                            <span class="error invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <textarea id="edit_package_description_{{$travelPackage['id']}}" name="edit_package_description"
                                          class="@error('edit_package_description') is-invalid @enderror" required>{{ $travelPackage['description'] }}</textarea>
                                        @error('edit_package_description')
                                          <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                      </div>
                                      <div class="form-group">
                                        <select name="edit_package_active"
                                          class="form-control @error('edit_package_active') is-invalid @enderror" required>
                                          <option value="active" {{ $travelPackage['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                                          <option value="inactive" {{ $travelPackage['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak
                                          </option>
                                        </select>
                                        @error('edit_package_active')
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
                          <div class="modal fade" id="modal-package-delete-{{ $travelPackage['id'] }}" data-backdrop="static"
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
                                  <form action="{{ route('tour-travel.delete-package', $travelPackage['id']) }}" method="POST">
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
          {{-- paket wisata --}}

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
  <!-- bs-custom-file-input -->
  <script src="{{ asset('temp-adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  {{-- sweet alert --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

      const summernote_toolbar_2 = [
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
      const summernote_popover_2 = {
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
      $('#package_description').summernote({
        placeholder: 'Detail informasi paket wisata...',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar_2,
        popover: summernote_popover_2
      })
      $('#package-description-edit').summernote({
        placeholder: 'Detail informasi paket wisata...',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar_2,
        popover: summernote_popover_2
      })
      $('#package-description-direct').summernote({
        placeholder: 'Detail informasi paket wisata...',
        tabsize: summernote_tabsize,
        height: summernote_height,
        toolbar: summernote_toolbar_2,
        popover: summernote_popover_2
      })

      @foreach ($travels as $key => $travel)
        $("#summernote-{{ $travel->id }}").summernote({
          placeholder: '',
          tabsize: summernote_tabsize,
          height: summernote_height,
          toolbar: summernote_toolbar,
          popover: summernote_popover
        })
      @endforeach      
      
      @foreach ($travelPackages as $key => $travelPackage)
        $("#edit_package_description_{{$travelPackage['id']}}").summernote({
          placeholder: '',
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
