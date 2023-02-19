$(document).ready(function () {
  bsCustomFileInput.init();
  $("#addItem").modal("hide");
});

const closeModalCustom = document.querySelectorAll(".close-custom-modal");
closeModalCustom.forEach((item) => {
  item.addEventListener("click", (event) => {
    console.log("ok");
    document.getElementById("modal-add-item-new").classList.add("d-none");
    $("#form-add-item")[0].reset();
  });
});

document.getElementById("button-add-item").addEventListener("click", () => {
  // $("#addItem").modal("show");
  document.getElementById("modal-add-item-new").classList.remove("d-none");
  $("#form-add-item")[0].reset();
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

document.getElementById("form-add-item").addEventListener("submit", (e) => {
  e.preventDefault();
  const url = document.getElementById("form-add-item").action;
  $.ajax({
    url,
    type: "POST",
    data: new FormData($("#form-add-item")[0]),
    contentType: false,
    processData: false,
    success: (data) => {
      console.log(data);
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: data.message,
      });
    },
    error: (data) => {
      console.log(data);
      Swal.fire({
        icon: "error",
        title: "Opps..",
        text: data.responseJSON.message,
      });
    },
  });
});
