// TinyMCE
// tinymce.init({
//   selector: '.textarea',
//   element_format : 'html', //new
//   width: 'auto',
//   height: '300'
// });

// Selectize
$(".select-beast").selectize({
  create: false,
  sortField: "text",
});
$(".select-state").selectize({
  maxItems: null,
  sortField: "text"
});

// Close Alert Completed
function closeAlert(){
  var alert = document.getElementById("alertComplete");
  alert.classList.add("d-none");
}

// Preview Image
function previewImage(){
  const imgPreview = document.querySelector('#img-profile');
  imgPreview.src = URL.createObjectURL(event.target.files[0]);
}