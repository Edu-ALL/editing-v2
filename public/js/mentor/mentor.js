// Menu Essay List
var checkEssay = false;
document.addEventListener("click", (evt) => {
  var essay = document.getElementById("essay");
  var menuEssay = document.getElementById('menu-essay');
  let targetEl = evt.target;     
  do {
    if (targetEl == essay) {
      menuEssay.classList.remove('d-none');
      checkEssay = true;
      return;
    } else if (checkEssay == true){
      menuEssay.classList.add('d-none');
      checkEssay = false;
      return;
    }
    targetEl = targetEl.parentNode;
  } while (targetEl);      
  menuEssay.classList.add('d-none');
});
// End Menu Essay List

// TinyMCE
tinymce.init({
  selector: '.textarea',
  width: 'auto',
  height: '300'
});

// Selectize
$(".select-beast").selectize({
  create: false,
  sortField: "text"
});

$(".select-date, .select-normal").selectize({
  create: false,
  sortField: "text"
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