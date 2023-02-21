$(document).ready(function () {
  bsCustomFileInput.init();
});

const closeModalCustom = document.querySelectorAll(".close-custom-modal");
closeModalCustom.forEach((item) => {
  item.addEventListener("click", (event) => {
    document.getElementById("modal-trash-item").classList.add("d-none");
    $("#form-add-item")[0].reset();
  });
});

let trashTableItem;
document.getElementById("trashButton").addEventListener("click", () => {
  const trashButton = document.querySelector("#trashButton");
  let id = trashButton.dataset.id;
  document.getElementById("modal-trash-item").classList.remove("d-none");
  let url = `/admin/extra-pages/${id}/trash-data-table`;
  trashTableItem = $("#dumpster-item").DataTable({
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
        data: "subcategory",
        name: "subcategory",
      },
      {
        data: "first_text",
        name: "first_text",
      },
      {
        data: "second_text",
        name: "second_text",
      },
      {
        data: "actions",
        name: "actions",
      },
    ],
  });
});

let talbeItem;
const category_id = document.getElementById("category_id").value;
let url = `/admin/extra-pages/${category_id}/data-table-item`;

talbeItem = $("#table-item-list").DataTable({
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
      data: "subcategory",
      name: "subcategory",
    },
    {
      data: "first_text",
      name: "first_text",
    },
    {
      data: "second_text",
      name: "second_text",
    },
    {
      data: "status",
      name: "status",
    },
    {
      data: "aksi",
      name: "aksi",
    },
  ],
});

document.getElementById("form-add-item").addEventListener("input", (e) => {
  let subcategory = document.getElementById("subcategory").value;
  let first_text = document.getElementById("first_text").value;
  let second_text = document.getElementById("second_text").value;
  let country = document.getElementById("country").value;
  let region = document.getElementById("region").value;
  let thumbnail = document.getElementById("thumbnail").value;
  let image = document.getElementById("image").value;
  let meta_description = document.getElementById("meta_description").value;
  let meta_keywords = document.getElementById("meta_keywords").value;
  let seo_title = document.getElementById("seo_title").value;
  let is_active = document.getElementById("is_active").value;
  let saveItem = document.getElementById("saveItem");

  if (
    subcategory === "" ||
    first_text === "" ||
    second_text === "" ||
    country === "" ||
    region === "" ||
    thumbnail === "" ||
    image === "" ||
    meta_description === "" ||
    meta_keywords === "" ||
    seo_title === "" ||
    is_active === ""
  ) {
    saveItem.disabled = true;
  } else {
    saveItem.disabled = false;
  }
});

// document.getElementById("form-add-item").addEventListener("submit", (e) => {
//   e.preventDefault();
//   const url = document.getElementById("form-add-item").action;
//   $.ajax({
//     url,
//     type: "POST",
//     data: new FormData($("#form-add-item")[0]),
//     contentType: false,
//     processData: false,
//     success: (data) => {
//       console.log(data);
//       $("#form-add-item")[0].reset()
//       talbeItem.ajax.reload()
//       Swal.fire({
//         icon: "success",
//         title: "Sukses",
//         text: data.message,
//       });
//       // location.reload();
//     },
//     error: (data) => {
//       console.log(data);
//       Swal.fire({
//         icon: "error",
//         title: "Opps..",
//         text: data.responseJSON.message,
//       });
//     },
//   });
// });

const deleteItem = (id) => {
  let url = "/admin/extra-pages/" + id;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Semua paket yang berhubungan dengan item ini akan dinonaktifkan dan item akan dihapus",
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
          talbeItem.ajax.reload();
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
      Swal.fire("Dibatalkan", "Item tidak dihapus", "error");
    }
  });
};

const restoreItem = (id) => {
  let url = `/admin/extra-pages/${id}/restore`;

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Semua paket yang berhubungan dengan item ini akan diaktifkan dan item akan dipulihkan",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, pulihkan!",
    cancelButtonText: "Tidak, batalkan!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url,
        type: "GET",
        contentType: false,
        processData: false,
        success: (data) => {
          talbeItem.ajax.reload();
          trashTableItem.ajax.reload();
          Swal.fire("Dipulihkan!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Item tidak dipulihkan", "error");
    }
  });
};

const removeItem = (id) => {
  let url = `/admin/extra-pages/${id}/destroy`;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Jika item ini dihapus, maka semua paket yang berhubungan akan ikut dimusnakan dan tidak akan bisa dipulihkan kembali",
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
          talbeItem.ajax.reload();
          trashTableItem.ajax.reload();
          Swal.fire("Musnah!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Item tidak dimusnahkan", "error");
    }
  });
};

document.getElementById("form-add-subitem").addEventListener("input", () => {
  console.log(document.getElementById("subitem_description").value);
  if (
    document.getElementById("item_id").value === "" ||
    document.getElementById("package_name").value === "" ||
    document.getElementById("image_subitem").value === "" ||
    document.getElementById("is_active_subitem").value === ""
  ) {
    document.getElementById("saveSubitem").disabled = true;
  } else {
    document.getElementById("saveSubitem").disabled = false;
  }
});

let tableSubitemList;
$(() => {
  let id = document.getElementById("category_id").value;
  let url = `/admin/extra-pages/subitem/data-table/${id}`;

  tableSubitemList = $("#table-subitem-list").DataTable({
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
        data: "subname",
        name: "subname",
      },
      {
        data: "package_name",
        name: "package_name",
      },
      {
        data: "price",
        name: "price",
      },
      {
        data: "image",
        name: "image",
      },
      {
        data: "status",
        name: "status",
      },
      {
        data: "aksi",
        name: "aksi",
      },
    ],
  });
});

const deletePackage = (id) => {
  let url = `/admin/extra-pages/subitem/delete/${id}`;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Item akan dihapus",
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
          tableSubitemList.ajax.reload();
          Swal.fire("Terhapus!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Gagal!", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Item tidak dihapus", "error");
    }
  });
};

let tableTrashSubitem;
document
  .getElementById("button-trash-subitem")
  .addEventListener("click", () => {
    $("#modalTrashSubitem").modal("show");
    let id = document.getElementById("category_id").value;
    let url = `/admin/extra-pages/subitem/data-table-trash/${id}`;
    tableTrashSubitem = $("#talbe-trash-subitem").DataTable({
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
          data: "subcategory",
          name: "subcategory",
        },
        {
          data: "package_name",
          name: "package_name",
        },
        {
          data: "aksi",
          name: "aksi",
        },
      ],
    });
  });

const restorePackage = (id) => {
  let url = `/admin/extra-pages/subitem/restore/${id}`;

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Semua paket yang berhubungan dengan item ini akan diaktifkan dan item akan dipulihkan",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Ya, pulihkan!",
    cancelButtonText: "Tidak, batalkan!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url,
        type: "GET",
        contentType: false,
        processData: false,
        success: (data) => {
          tableSubitemList.ajax.reload();
          tableTrashSubitem.ajax.reload();
          Swal.fire("Dipulihkan!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Item tidak dipulihkan", "error");
    }
  });
};

const destroyPackage = (id) => {
  let url = `/admin/extra-pages/subitem/destroy/${id}`;
  let csrf_token = $('meta[name="csrf-token"]').attr("content");

  Swal.fire({
    title: "Apakah anda yakin?",
    text: "Item akan dimusnaahkan selamanya",
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
          tableSubitemList.ajax.reload();
          tableTrashSubitem.ajax.reload();
          Swal.fire("Musnah!", data.message, "success");
        },
        error: (data) => {
          Swal.fire("Error", data.responseJSON.message, "error");
        },
      });
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire("Dibatalkan", "Item tidak dimusnahkan", "error");
    }
  });
};
