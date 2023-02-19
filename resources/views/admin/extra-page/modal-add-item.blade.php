<div class="modal-custom scale-in-center">
	<form action="{{ route('extra-pages.ajax-store-item', $category['id']) }}" method="post" class="w-100 mx-auto"
		 enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="category" id="category" value="{{ $category['id'] }}">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addCategoryLabel">Tambah Item {{ ucfirst($title) }}</h5>
				<button type="button" class="close close-custom-modal">
					<a>&times;</a>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm col-lg-4 col-md-4 mb-3">
						<input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Judul"
							maxlength="30" required>
					</div>
					<div class="col-sm col-lg-4 col-md-4 mb-3">
						<input type="text" name="first_text" id="first_text" class="form-control" placeholder="Kalimat pendukung"
							maxlength="30" required>
					</div>
					<div class="col-sm col-lg-4 col-md-4 mb-3">
						<input type="text" name="second_text" id="second_text" class="form-control" placeholder="Harga mulai..."
							maxlength="30" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm col-lg-6 col-md-6 mb-3">
						<input type="text" name="country" id="country" class="form-control" placeholder="Negara..."
							max="100" required>
					</div>
					<div class="col-sm col-lg-6 col-md-6 mb-3">
						<input type="text" name="region" id="region" class="form-control" placeholder="Daerah.."
							max="100" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*" required>
							<label class="custom-file-label text-muted" for="thumbnail">Pilih Thumbnail</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="image" accept="image/*"
								required>
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
								placeholder="Meta description (Deskripsi singkat kontent)" maxlength="255" required>
						</div>
						<div class="form-group">
							<label for="meta_keywords" style="font-size: 14px">Meta Keywords</label>
							<input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
								placeholder="Meta keywords (jika kata kunci lebih dari 1 pisahkan dengan ',' koma)" maxlength="255"
								required>
						</div>
						<div class="form-group">
							<label for="seo_title" style="font-size: 14px">SEO Title</label>
							<input type="text" class="form-control" name="seo_title" id="seo_title"
								placeholder="Judul untuk seo (minimal 5 kali disebutkan di artikel dan dibold)" maxlength="255"
								required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<select name="is_active" id="is_active" class="form-control" required>
						<option selected disabled>Ditampilkan?</option>
						<option value="active">Ya</option>
						<option value="inactive">Tidak</option>
					</select>
				</div>
				<div class="form-group">
					<textarea name="item_description" id="item_description" class="ckeditor shadow-lg"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary close-custom-modal">Close</button>
				<button type="submit" id="saveItem" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</form>
</div>