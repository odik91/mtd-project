$(document).ready(function () {
  bsCustomFileInput.init();
});

document.getElementById("form-edit-item").addEventListener("input", (e) => {
  let subcategory = document.getElementById("subcategory").value;
  let first_text = document.getElementById("first_text").value;
  let second_text = document.getElementById("second_text").value;
  let country = document.getElementById("country").value;
  let region = document.getElementById("region").value;
  let meta_description = document.getElementById("meta_description").value;
  let meta_keywords = document.getElementById("meta_keywords").value;
  let seo_title = document.getElementById("seo_title").value;
  let is_active = document.getElementById("is_active").value;
  let saveItem = document.getElementById("editItem");

  if (
    subcategory === "" ||
    first_text === "" ||
    second_text === "" ||
    country === "" ||
    region === "" ||
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
