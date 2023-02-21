<form action="{{ route('extra-pages.subitem.store') }}" method="post" class="w-100 mx-auto" enctype="multipart/form-data" id="form-add-subitem">
  @csrf
  <div class="card-body">
    <div class="row">
      <div class="col-sm col-lg-12 col-md-12 mb-3">
        <select class="form-control" name="item_id" id="item_id">
					<option value="" selected disabled>Pilih Item</option>
					@foreach (App\Models\Subcategory::where('category_id', $category['id'])->get() as $subcategory)
					<option value="{{ $subcategory['id'] }}">{{ $subcategory['subcategory'] }}</option>
					@endforeach
				</select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm col-lg-6 col-md-6 mb-3">
        <input type="text" name="package_name" id="package_name" class="form-control" placeholder="Nama paket" max="100"
          required autocomplete="package_name">
      </div>
      <div class="col-sm col-lg-6 col-md-6 mb-3">
        <input type="text" name="price_subitem" id="price_subitem" class="form-control" placeholder="Harga" max="100"
          required autocomplete="price">
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image_subitem" name="image_subitem" accept="image/*" required>
          <label class="custom-file-label text-muted" for="image">Pilih Gambar</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <select name="is_active_subitem" id="is_active_subitem" class="form-control" required>
        <option selected disabled>Ditampilkan?</option>
        <option value="active">Ya</option>
        <option value="inactive">Tidak</option>
      </select>
    </div>
    <div class="form-group">
      <textarea name="subitem_description" id="subitem_description" class="ckeditor shadow-lg"></textarea>
    </div>
    <div class="card-footer text-right">
      {{-- <button type="button" class="btn btn-secondary close-custom-modal">Close</button> --}}
      <button type="submit" id="saveSubitem" class="btn btn-primary" disabled>Simpan</button>
    </div>
  </div>
</form>
