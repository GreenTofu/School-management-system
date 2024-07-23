console.log("Hello");
var fileInput = document.querySelector(".inputID-1");
var icon = document.querySelector(".myicon-1");
var form = document.querySelector(".upload-1");
var element = document.querySelector('.wrapper-1 .file-upload-1');
var button = document.querySelector(".saveBtn");
var addModal = document.querySelector(".add-modal-body");

var fileInput2 = document.querySelector(".inputID-2");
var icon2 = document.querySelector(".myicon-2");
var form2 = document.querySelector(".upload-2");
var element2 = document.querySelector('.wrapper-2 .file-upload-2');
var changeSaveBtn = document.querySelector(".changeSaveBtn");
var changeModal = document.querySelector(".change-modal-body");

var option = document.querySelectorAll("option");
var select = document.getElementsByName("attempt-select");

const ext = ["png", "jpg", "jpeg", "pdf", "x-zip-compressed"]

button.disabled = true;
changeSaveBtn.disabled = true;

fileInput.addEventListener('change', function() {
    var file = fileInput.files[0];
    var type = file.type.split("/");
    var fileType = type.slice(-1);
    if(ext.includes(fileType[0])){
        icon.classList.remove("fa-arrow-up");
        icon.classList.remove("fa-x");
        // icon.classList.remove("text-primary");
        icon.classList.add("fa-check");
        // icon.classList.add("text-success");
        element.style.backgroundPosition = '0 -100%';
        element.style.color = '#198754';
        element.style.backgroundImage = "linear-gradient(to bottom, #198754 50%, #FFFFFF 50%)";
        addModal.style.background = "#198754";
        button.disabled = false;
    }else{
        icon.classList.remove("fa-arrow-up");
        icon.classList.remove("fa-check");
        // icon.classList.remove("text-primary");
        icon.classList.add("fa-x");
        // icon.classList.add("text-success");
        element.style.backgroundPosition = '0 -100%';
        element.style.color = '#dc3545';
        element.style.backgroundImage = "linear-gradient(to bottom, #dc3545 50%, #FFFFFF 50%)";
        addModal.style.background = "#dc3545";
        fileInput.value = "";
        alert("file extension is not allowed");
        button.disabled = true;
    }
}, false)
button.addEventListener("click", function (){
    form.submit();
})

fileInput2.addEventListener('change', function() {
    var file = fileInput2.files[0];
    var type = file.type.split("/");
    var fileType = type.slice(-1);
    console.log(file);
    console.log(type);
    if(ext.includes(fileType[0])){
        // console.log("true");
        icon2.classList.remove("fa-arrow-up");
        icon2.classList.remove("fa-x");
        // icon.classList.remove("text-primary");
        icon2.classList.add("fa-check");
        // icon.classList.add("text-success");
        element2.style.backgroundPosition = '0 -100%';
        element2.style.color = '#198754';
        element2.style.backgroundImage = "linear-gradient(to bottom, #198754 50%, #FFFFFF 50%)";
        changeModal.style.background = "#198754";
        changeSaveBtn.disabled = false;
    }else{
        // console.log("false");
        icon2.classList.remove("fa-arrow-up");
        icon2.classList.remove("fa-check");
        // icon.classList.remove("text-primary");
        icon2.classList.add("fa-x");
        // icon.classList.add("text-success");
        element2.style.backgroundPosition = '0 -100%';
        element2.style.color = '#dc3545';
        element2.style.backgroundImage = "linear-gradient(to bottom, #dc3545 50%, #FFFFFF 50%)";
        changeModal.style.background = "#dc3545";
        fileInput2.value = "";
        alert("file extension is not allowed");
        changeSaveBtn.disabled = true;
    }
}, false)
changeSaveBtn.addEventListener("click", function (){
    form2.submit();
})

select.addEventListener("change", function(){
    for(var i = 0; i < select[0].length; i++){

    }
})