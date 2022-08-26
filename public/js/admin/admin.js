// Menu Users
var checkUsers = false;
document.addEventListener("click", (evt) => {
  var users = document.getElementById("users");
  var menuUsers = document.getElementById('menu-users');
  let targetEl = evt.target;     
  do {
    if (targetEl == users) {
      menuUsers.classList.remove('d-none');
      checkUsers = true;
      return;
    } else if (checkUsers == true){
      menuUsers.classList.add('d-none');
      checkUsers = false;
      return;
    }
    targetEl = targetEl.parentNode;
  } while (targetEl);      
  menuUsers.classList.add('d-none');
});
// End Menu Users

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

// Menu Export Excel
var checkExport = false;
document.addEventListener("click", (evt) => {
  var excel = document.getElementById("export");
  var menuExport = document.getElementById('menu-export');
  let targetEl = evt.target;     
  do {
    if (targetEl == excel) {
      menuExport.classList.remove('d-none');
      checkExport = true;
      return;
    } else if (checkExport == true){
      menuExport.classList.add('d-none');
      checkExport = false;
      return;
    }
    targetEl = targetEl.parentNode;
  } while (targetEl);      
  menuExport.classList.add('d-none');
});
// End Menu Export Excel

// Menu Setting
var checkSetting = false;
document.addEventListener("click", (evt) => {
  var setting = document.getElementById("setting");
  var menuSetting = document.getElementById('menu-setting');
  let targetEl = evt.target;     
  do {
    if (targetEl == setting) {
      menuSetting.classList.remove('d-none');
      checkSetting = true;
      return;
    } else if (checkSetting == true){
      menuSetting.classList.add('d-none');
      checkSetting = false;
      return;
    }
    targetEl = targetEl.parentNode;
  } while (targetEl);      
  menuSetting.classList.add('d-none');
});
// End Menu Setting

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
  create: false
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