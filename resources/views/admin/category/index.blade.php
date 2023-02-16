@extends('admin.layouts.master')
@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ ucwords($title) }}</h1>
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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                List Kategori
              </h3>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-sm-12 col-md-3 col-lg-3 mb-2">
                  <button class="btn btn-block btn-outline-primary badge-pill" data-toggle="modal"
                    data-target="#addCategory">Tambah Kategori</button>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 mb-2"></div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-right mb-2">
                  <button class="btn btn-block btn-outline-danger badge-pill" data-toggle="modal"
                  data-target="#trash" id="trashButton">Tong Sampah
                    Kategori</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="table-category">
                  <thead class="table-primary">
                    <tr>
                      <th>#</th>
                      <th>Kategori</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- modal tambah kategori --}}
  <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form action="{{ route('category.store') }}" method="post" class="w-100 mx-auto" id="form-category">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCategoryLabel">Tambah Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="kategori">Kategori <span class="text-danger">* <small><i>(wajib di
                      isi)</i></small></span></label>
              <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan kategori"
                required>
              <small id="kategoriHelp" class="form-text"></small>
            </div>
            <div class="form-group">
              <label for="description">Keterangan</label>
              <input type="text" name="description" id="description" class="form-control"
                placeholder="Masukkan keterangan" required>
            </div>
            <div class="form-group">
              <label for="status">Status <span class="text-danger">*</span></label>
              <select name="status" id="status" class="form-control">
                <option value="" selected disabled>Pilih status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
              </select>
              <small id="statusHelp" class="form-text"></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="saveCategory" class="btn btn-primary" disabled>Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  {{-- end modal tambah kategori --}}

  {{-- modal edit kategori --}}
  <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form action="" method="post" class="w-100 mx-auto" id="form-edit-category">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryLabel">Edit Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="kategori-edit">Kategori <span class="text-danger">* <small><i>(wajib di
                      isi)</i></small></span></label>
              <input type="text" name="kategori-edit" id="kategori-edit" class="form-control"
                placeholder="Masukkan kategori" required>
              <small id="kategoriHelp" class="form-text"></small>
            </div>
            <div class="form-group">
              <label for="description-edit">Keterangan</label>
              <input type="text" name="description-edit" id="description-edit" class="form-control"
                placeholder="Masukkan keterangan" required>
            </div>
            <div class="form-group">
              <label for="status-edit">Status <span class="text-danger">*</span></label>
              <select name="status-edit" id="status-edit" class="form-control">
                <option value="" selected disabled>Pilih status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
              </select>
              <small id="statusHelp" class="form-text"></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="saveCategoryEdit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  {{-- end modal edit kategori --}}

  {{-- modal tong sampah --}}
  <div class="modal fade" id="trash" tabindex="-1" role="dialog" aria-labelledby="trashLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="trashLabel">Tong sampah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover w-100" id="table-trash-category">
              <thead class="table-info">
                <tr>
                  <th>#</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" id="saveCategoryEdit" class="btn btn-primary">Simpan</button> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- end modal tong sampah --}}
@endsection

@push('addon-js')
  <!-- DataTable -->
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  {{-- sweet alert --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/category.js') }}"></script>
@endpush

@push('addon-css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endpush
