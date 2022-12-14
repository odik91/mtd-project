@extends('admin.layouts.master')

@section('content')
  <div class="container-fluid">
    <div class="mb-2"><i class="fa-solid fa-arrows-turn-to-dots"></i> Pengaturan Utama / <span class="text-muted">Halaman
        Utama</span>
    </div>

    {{-- slider setting --}}
    <div class="card shadow mb-4 p-2">
      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Jumbotron Slider Setting</h6>
      </div>
      <div class="card-body">
        <form action="">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputBackground" required>
            <label class="custom-file-label" for="inputBackground">Pilih backgroud slider...</label>
          </div>
          <div class="form-row mt-3">
            <div class="col">
              <input type="text" class="form-control" placeholder="Judul">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Slogan">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Kalimat ajakan">
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" placeholder="Link halaman web">
          </div>
          <div class="form-group mt-3">
            <select name="" id="" class="form-control">
              <option selected disabled>Apakah slider aktif</option>
              <option value="active">Aktif</option>
              <option value="inactive">Tidak aktif</option>
            </select>
          </div>
          <button class="btn btn-block btn-primary">Tambahkan</button>
        </form>
        <hr class="my-5">
        <div class="mt-4">
          <div class="card">
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-secondary text-center">Daftar Slider</h6>
            </div>
            <div class="card-body">
              <table id="tableSlider" class="table table-responsive p-0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Background</th>
                    <th>Judul</th>
                    <th>Slogan</th>
                    <th>Kalimat Ajakan</th>
                    <th>Link Halaman Web</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>
                      <select class="form-control">
                        <option selected disabled>Aktifkan</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                      </select>
                    </td>
                    <td>
                      <a href="#" class="btn btn-warning mx-2 mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                      <a href="#" class="btn btn-danger mx-2 mb-2"><i class="fa-regular fa-trash-can"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end slider setting --}}

    {{-- main service --}}
    <div class="card shadow mb-4 p-2">
      <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Tiga Layanan Utama</h6>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-center">
          <div class="card text-center" style="width: 18rem;">
            <div class="card-header">
              Layanan 1
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
              2 days ago
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end main service --}}
  </div>
@endsection

@push('addon-css')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
@endpush

@push('addon-js')
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tableSlider').DataTable();
    });
  </script>
@endpush
