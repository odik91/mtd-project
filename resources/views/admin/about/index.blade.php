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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Peta Pinpoint Alamat Di Gmap
              </h3>
            </div>
            <div class="card-body">
              <figure class="" id="maps">
                @if (empty($about['maps']))
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.073743136394!2d104.09675885390627!3d1.134014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98629440c5757%3A0x7e57149ff963910c!2sPuri%20Selebriti%201!5e0!3m2!1sen!2sid!4v1670749845476!5m2!1sen!2sid"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                  {!! $about['maps'] !!}
                @endif
              </figure>
              <form action="{{ route('about.store', $about['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body mb-3">
                  <label for="gmap">Masukkan frame peta dari google map</label>
                  <textarea id="gmap" name="gmap" class="form-control" cols="30" rows="10"
                    placeholder="Masukkan frame peta dari google map <iframe src='https://www.google.com/maps/embed?>....</iframe>"></textarea>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('logo_about') is-invalid @enderror"
                        name="logo_about" id="logo_about" accept="image/*" name="logo_about" required>
                      <label class="custom-file-label text-muted" for="logo_about-01">Logo utama halaman about</label>
                      @error('logo_about')
                        <span class="error invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('logo_slider') is-invalid @enderror"
                        name="logo_slider" id="thumnail-01" accept="image/*" name="logo_slider" required>
                      <label class="custom-file-label text-muted" for="logo_slider">Logo header setiap halaman</label>
                    </div>
                    @error('logo_slider')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('logo_footer') is-invalid @enderror"
                        name="logo_footer" id="thumnail-01" accept="image/*" name="logo_footer" required>
                      <label class="custom-file-label text-muted" for="thumnail-01">Logo footer setiap halaman</label>
                      @error('logo_footer')
                        <span class="error invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm col-lg-6 col-md-6 mb-3">
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                      placeholder="Alamat" required>
                    @error('alamat')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-sm col-lg-6 col-md-6 mb-3">
                    <input type="text" name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror"
                      placeholder="Kelurahan" required>
                    @error('kelurahan')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm col-lg-4 col-md-4 mb-3">
                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                      placeholder="Kecamatan" required>
                    @error('kecamatan')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-sm col-lg-4 col-md-4 mb-3">
                    <input type="text" name="kabupaten"
                      class="form-control @error('kabupaten') is-invalid @enderror" placeholder="Kota" required>
                    @error('kabupaten')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-sm col-lg-4 col-md-4 mb-3">
                    <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror"
                      placeholder="Provinsi" required>
                    @error('provinsi')
                      <span class="error invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-block btn-outline-info mt-2">Terapkan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

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

    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script>
@endpush
