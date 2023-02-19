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
                href="{{ route('extra-pages.main', $subcategory->getCategory['id']) }}">{{ $subcategory->getCategory['category'] }}</a>
            </li>
            <li class="breadcrumb-item active">{{ ucwords($subcategory['subcategory']) }}</li>
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
                  <form action="{{ route('extra-pages.update-item', $subcategory['id']) }}" method="post"
                    class="w-100 mx-auto" enctype="multipart/form-data" id="form-edit-item">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="subcategory" id="subcategory" class="form-control"
                            placeholder="Judul" maxlength="30" value="{{ $subcategory['subcategory'] }}" required>
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="first_text" id="first_text" class="form-control"
                            placeholder="Kalimat pendukung" maxlength="30" value="{{ $subcategory['first_text'] }}"
                            required>
                        </div>
                        <div class="col-sm col-lg-4 col-md-4 mb-3">
                          <input type="text" name="second_text" id="second_text" class="form-control"
                            placeholder="Kalimat pelengkap" maxlength="30" value="{{ $subcategory['second_text'] }}"
                            required>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="country" id="country" class="form-control" placeholder="Negara..."
                            max="100" value="{{ $subcategory['country'] }}" required>
                        </div>
                        <div class="col-sm col-lg-6 col-md-6 mb-3">
                          <input type="text" name="region" id="region" class="form-control" placeholder="Daerah.."
                            max="100" value="{{ $subcategory['region'] }}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail"
                              accept="image/*">
                            <label class="custom-file-label text-muted" for="thumbnail">Pilih Thumbnail</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image"
                              accept="image/*">
                            <label class="custom-file-label text-muted" for="image">Pilih Gambar</label>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <h6 class="text-center">SEO Content</h6>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label for="meta_description" style="font-size: 14px">Meta Description</label>
                            <input type="text" class="form-control" name="meta_description" id="meta_description"
                              placeholder="Meta description (Deskripsi singkat kontent)" maxlength="255"
                              value="{{ $seo['meta_description'] }}" required>
                          </div>
                          <div class="form-group">
                            <label for="meta_keywords" style="font-size: 14px">Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                              placeholder="Meta keywords (jika kata kunci lebih dari 1 pisahkan dengan ',' koma)"
                              maxlength="255" value="{{ $seo['meta_keywords'] }}" required>
                          </div>
                          <div class="form-group">
                            <label for="seo_title" style="font-size: 14px">SEO Title</label>
                            <input type="text" class="form-control" name="seo_title" id="seo_title"
                              placeholder="Judul untuk seo (minimal 5 kali disebutkan di artikel dan dibold)"
                              maxlength="255" value="{{ $seo['seo_title'] }}" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <select name="is_active" id="is_active" class="form-control" required>
                          <option selected disabled>Ditampilkan?</option>
                          <option value="active" {{ $subcategory['is_active'] == 'active' ? 'selected' : '' }}>Ya
                          </option>
                          <option value="inactive" {{ $subcategory['is_active'] == 'inactive' ? 'selected' : '' }}>Tidak
                          </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <textarea name="item_description" id="item_description" class="ckeditor shadow-lg">
													{!! $subcategory['description'] !!}
												</textarea>
                      </div>
                      <div class="card-footer text-right">
                        <a href="{{ route('extra-pages.main', $subcategory->getCategory['id']) }}"
                          class="btn btn-secondary close-custom-modal">Batal</a>
                        <button type="submit" id="editItem" class="btn btn-primary" disabled>Simpan</button>
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

  <script src="{{ asset('js/cotegory-management-edit.js') }}"></script>
@endpush
