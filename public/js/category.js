let tableCategory;
let url = "/admin/categories/data-table";
tableCategory = $("#table-category").DataTable({
  processing: true,
  serverSide: true,
  ajax: url,
  responsive: true,
  columns: [
    {
      data: "DT_RowIndex",
      name: "DT_RowIndex",
    },
    {
      data: "category",
      name: "category",
    },
    {
      data: "desciption",
      name: "desciption",
    },
    {
      data: "status",
      name: "status",
    },
    {
      data: "actions",
      name: "actions",
    },
  ],
});

const checkInput = (element, display, namaInput) => {
  if (document.getElementById(element).value === "") {
    document.getElementById(
      display
    ).innerHTML = `<span class=" text-danger">${namaInput} tidak boleh kosong</span>`;
  } else {
    document.getElementById(display).innerHTML = "";
  }
};

document.getElementById("form-category").addEventListener("input", (e) => {
  checkInput("kategori", "kategoriHelp", "Kategori");
  checkInput("status", "statusHelp", "Status");

  if (
    document.getElementById("kategori").value === "" ||
    document.getElementById("status").value === ""
  ) {
    document.getElementById("saveCategory").disabled = true;
  } else {
    document.getElementById("saveCategory").disabled = false;
  }
});

document.getElementById("form-category").addEventListener("submit", (e) => {
  e.preventDefault();
  let formData = new FormData($("#form-category")[0]);
  const url = "/admin/category";

  $.ajax({
    url,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: (data) => {
      const extraMenu = document.getElementById("extra-menu");
      extraMenu.innerHTML = "";

      const menu = data.menu;
      let menuData = "";

      menu.map((item, key) => {
        let setTag = `
        <li class="nav-item">
          <a href="/admin/extra-pages/${item.id}" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              ${item.category}
            </p>
          </a>
        </li>`;
        return (menuData += setTag);
      });

      extraMenu.innerHTML += menuData;

      $("#form-category")[0].reset();
      tableCategory.ajax.reload();
      $("#addCategory").modal("hide");
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: data.message,
      });
    },
    error: (data) => {
      Swal.fire({
        icon: "error",
        title: "Opps..",
        text: data.responseJSON.message,
      });
    },
  });
});

const edit = (id) => {
  $("#editCategory").modal("show");
  $("#form-edit-category")[0].reset();
  let url = "/admin/category/" + id;

  $.ajax({
    url,
    type: "GET",
    contentType: false,
    processData: false,
    success: (data) => {
      document.getElementById("kategori-edit").value = data.category;
      document.getElementById("description-edit").value = data.desciption;
      document.getElementById("status-edit").value = data.is_active;
      document.getElementById("form-edit-category").action =
        "/admin/category/" + data.id;
    },
    error: (data) => {
      Swal.fire({
        icon: "error",
        title: "Opps..",
        text: data.responseJSON.message,
      });
    },
  });
};

document
  .getElementById("form-edit-category")
  .addEventListener("submit", (e) => {
    e.preventDefault();
    let url = document.getElementById("form-edit-category").action;
    if (
      document.getElementById("kategori-edit").value === "" &&
      document.getElementById("status-edit").value === ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Opps..",
        text: "Mohon isi semua kolom yang wajib",
      });
    } else {
      $.ajax({
        url,
        type: "POST",
        data: new FormData($("#form-edit-category")[0]),
        contentType: false,
        processData: false,
        success: (data) => {
          const extraMenu = document.getElementById("extra-menu");
          extraMenu.innerHTML = "";

          const menu = data.menu;
          let menuData = "";

          menu.map((item, key) => {
            let setTag = `
              <li class="nav-item">
                <a href="/admin/extra-pages/${item.id}" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    ${item.category}
                  </p>
                </a>
              </li>`;
            return (menuData += setTag);
          });

          extraMenu.innerHTML += menuData;

          $("#form-edit-category")[0].reset();
          tableCategory.ajax.reload();
          $("#editCategory").modal("hide");
          Swal.fire({
            icon: "success",
            title: "Sukses",
            text: data.message,
          });
        },
        error: (data) => {
          Swal.fire({
            icon: "error",
            title: "Opps..",
            text: data.responseJSON.message,
          });
        },
      });
    }
  });

const deleteCategory = ($id) => {
  let url = "/admin/category/" + $id;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Semua paket yang berhubungan dengan kategori ini akan dinonaktifkan dan kategori akan dihapus",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Tidak, batalkan!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url,
        type: "POST",
        data: {
          _method: "DELETE",
          _token: csrf_token,
        },
        success: (data) => {
          const extraMenu = document.getElementById("extra-menu");
          extraMenu.innerHTML = "";

          const menu = data.menu;
          let menuData = "";

          menu.map((item, key) => {
            let setTag = `
              <li class="nav-item">
                <a href="/admin/extra-pages/${item.id}" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    ${item.category}
                  </p>
                </a>
              </li>`;
            return (menuData += setTag);
          });

          extraMenu.innerHTML += menuData;

          tableCategory.ajax.reload();
          Swal.fire("Terhapus!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Kategori tidak dihapus", "error");
    }
  });
};

// datatable trash category
let trashTable;
document.getElementById("trashButton").addEventListener("click", (e) => {
  const url = "/admin/categories/data-table-trash-category";
  trashTable = $("#table-trash-category").DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    ajax: url,
    responsive: true,
    columns: [
      {
        data: "DT_RowIndex",
        name: "DT_RowIndex",
      },
      {
        data: "category",
        name: "category",
      },
      {
        data: "actions",
        name: "actions",
        orderable: false,
        searchable: false,
      },
    ],
  });
});

const restoreCategory = (id) => {
  let url = window.location.origin + "/admin/restore-category/" + id;
  $.ajax({
    url,
    type: "GET",
    success: (data) => {
      const extraMenu = document.getElementById("extra-menu");
      extraMenu.innerHTML = "";

      const menu = data.menu;
      let menuData = "";

      menu.map((item, key) => {
        let setTag = `
              <li class="nav-item">
                <a href="/admin/extra-pages/${item.id}" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    ${item.category}
                  </p>
                </a>
              </li>`;
        return (menuData += setTag);
      });

      extraMenu.innerHTML += menuData;

      trashTable.ajax.reload();
      tableCategory.ajax.reload();
      Swal.fire({
        icon: "success",
        title: "Success",
        text: data.message,
      });
    },
    error: (data) => {
      Swal.fire({
        icon: "error",
        title: "Opps..",
        text: data.responseJSON.message,
      });
    },
  });
};

const destroyCategory = (id) => {
  let url = "/admin/category-destroy/" + id;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Semua paket yang berhubungan dengan kategori ini akan dimusnahkan secara permanent",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, musnahkan!",
    cancelButtonText: "Tidak, batalkan!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url,
        type: "POST",
        data: {
          _method: "DELETE",
          _token: csrf_token,
        },
        success: (data) => {
          trashTable.ajax.reload();
          tableCategory.ajax.reload();
          Swal.fire("Terhapus!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Kategori tidak musnahkan", "error");
    }
  });
};
