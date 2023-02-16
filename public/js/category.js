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
            $("#form-category")[0].reset();
            tableCategory.ajax.reload()
            $("#addCategory").modal("hide");
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
});

const edit = (id) => {
    $("#editCategory").modal("show");
    let url = '/admin/category/' + id

    $.ajax({
        url,
        type: "GET",
        contentType: false,
        processData: false,
        success: (data) => {
            console.log(data);
            
        },
        error: (data) => {
            console.log(data);
        }
    })
}
