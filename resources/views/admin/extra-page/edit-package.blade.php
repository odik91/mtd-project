@extends('admin.layouts.master')

@push('addon-css')
  {{--  --}}
@endpush

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
            <li class="breadcrumb-item"><a
                href="{{ route('extra-pages.main', $package->getSubcategory->getCategory['id']) }}">{{ ucwords($package->getSubcategory->getCategory['category']) }}</a>
            </li>
            <li class="breadcrumb-item active">{{ ucwords($package['package_name']) }}</li>
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
                List Item {{ ucwords($title) }}
              </h3>
            </div>
            <div class="card-body">
              <div>
                <div class="card bordered">
                  <div class="card-header">
                    <div class="d-flex justify-content-between">
                      <h5 class="card-title">{{ ucwords($title) }}</h5>
                    </div>
                  </div>
                  <form action="{{ route('extra-pages.subitem.update', $package['id']) }}" method="post"
                    class="w-100 mx-auto" enctype="multipart/form-data" id="form-edit-subitem">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm col-lg-12 col-md-12 mb-3">
                          <select class="form-control" name="item_id" id="item_id">
                            <option value="" disabled>Pilih Item</option>
                            @foreach (App\Models\Subcategory::where('category_id', $package->getSubcategory->getCategory['id'])->get() as $subcategory)
                              <option value="{{ $subcategory['id'] }}"
                                {{ $subcategory['id'] == $package['subcategory_id'] ? 'selected' : '' }}>
                                {{ $subcategory['subcategory'] }}
                              </option>
                            @endforeach
                          </select>
                          @error('item_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="package_name" id="package_name" class="form-control"
                            placeholder="Nama paket" max="100" value="{{ $package['package_name'] }}" required
                            autocomplete="package_name">
                          @error('package_name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="price_subitem" id="price_subitem" class="form-control"
                            placeholder="Harga" max="100" value="{{ $package['price'] }}" required
                            autocomplete="price">
                          @error('price_subitem')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_subitem" name="image_subitem"
                              accept="image/*">
                            <label class="custom-file-label text-muted" for="image">Pilih Gambar</label>
                          </div>
                          @error('image_subitem')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group">
                        <select name="is_active_subitem" id="is_active_subitem" class="form-control" required>
                          <option disabled>Ditampilkan?</option>
                          <option value="active" {{ $package['is_active'] == 'active' ? 'selected' : '' }}>Ya</option>
                          <option value="inactive" {{ $package['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak
                          </option>
                        </select>
                        @error('is_active_subitem')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <textarea name="subitem_description" id="subitem_description" class="ckeditor shadow-lg">{!! $package['description'] !!}</textarea>
                        @error('subitem_description')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="card-footer text-right">
                        <button type="submit" id="saveSubitem" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('addon-js')
  <!-- bs-custom-file-input -->
  <script src="{{ asset('temp-adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('ckeditor/plugins/embed/plugin.js') }}"></script>
  <script src="{{ asset('ckeditor/plugins/colorbutton/plugin.js') }}"></script>
  <script src="{{ asset('ckeditor/plugins/panelbutton/plugin.js') }}"></script>

  {{-- <script src="{{ asset('js/cotegory-management-edit.js') }}"></script> --}}

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
@endpush
