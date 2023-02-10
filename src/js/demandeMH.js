const fileOneError = {
  IsError: false,
  message: { type: "", size: "" },
};
const fileTwoError = {
  IsError: false,
  message: { type: "", size: "" },
};
var fileOneInfo = {
  size: 0,
  type: "",
  selectedFile: null,
  name: "",
  Isuploaded: false,
};
var fileTwoInfo = {
  size: 0,
  type: "",
  selectedFile: null,
  name: "",
  Isuploaded: false,
};

const messageOneElement = document.querySelector(
  ".custom-file-uploadOne #message"
);
const messageTwoElement = document.querySelector(
  ".custom-file-uploadTwo #message"
);
const fileOneElement = document.getElementById("fileOne");
const fileTwoElement = document.getElementById("fileTwo");

const fileOneBorder = document.querySelector(".custom-file-uploadOne");
const fileTwoBorder = document.querySelector(".custom-file-uploadTwo");

fileOneElement.addEventListener("change", (e) => {
  var filename = e.target.files[0].name;
  fileOneInfo.name = filename;
  fileOneInfo.size = e.target.files[0].size;
  fileOneInfo.Isuploaded = true;
  fileOneInfo.selectedFile = e.target.files[0];
  var spileFilearray = filename.split(".");
  fileOneInfo.type = spileFilearray[spileFilearray.length - 1];

  ControlleFileOneUpload();
});

fileTwoElement.addEventListener("change", (e) => {
  var filename = e.target.files[0].name;
  fileTwoInfo.name = filename;
  fileTwoInfo.size = e.target.files[0].size;
  fileTwoInfo.Isuploaded = true;
  fileTwoInfo.selectedFile = e.target.files[0];
  var spileFilearray = filename.split(".");
  fileTwoInfo.type = spileFilearray[spileFilearray.length - 1];

  ControlleFileTwoUpload();
});

function ControlleFileTwoUpload() {
  var filetype = fileTwoInfo.type;
  var fileSize = fileTwoInfo.size;
  if (filetype != "xlsx" && filetype != "xls") {
    fileTwoError.IsError = true;
    fileTwoError.message.type = "-Le type de fichier n'est pas pris en charge";
  } else {
    fileTwoError.message.type = "";
    if (fileSize > 5_000_000) {
      fileTwoError.IsError = true;
      fileTwoError.message.size =
        "-trop gros (Plus De 5Mb) pour être téléchargé";
    } else {
      fileTwoError.IsError = false;
    }
  }
  if (fileTwoError.IsError) {
    messageTwoElement.style.color = "red";
    messageTwoElement.innerHTML = Object.values(fileTwoError.message).join(
      "<br>"
    );
    fileTwoBorder.style.borderColor = "red";
  } else {
    messageTwoElement.innerHTML = "";
    fileTwoError.message.type = "";
    fileTwoError.message.size = "";
    fileTwoBorder.style.borderColor = "#009879";
  }
}

function ControlleFileOneUpload() {
  var filetype = fileOneInfo.type;
  var fileSize = fileOneInfo.size;
  if (filetype != "xlsx" && filetype != "xls") {
    fileOneError.IsError = true;
    fileOneError.message.type = "-Le type de fichier n'est pas pris en charge";
  } else {
    fileOneError.message.type = "";
    if (fileSize > 5_000_000) {
      fileOneError.IsError = true;
      fileOneError.message.size =
        "-trop gros (Plus De 5Mb) pour être téléchargé";
    } else {
      fileOneError.IsError = false;
    }
  }
  if (fileOneError.IsError) {
    messageOneElement.style.color = "red";
    messageOneElement.innerHTML = Object.values(fileOneError.message).join(
      "<br>"
    );
    fileOneBorder.style.borderColor = "red";
  } else {
    messageOneElement.innerHTML = "";
    fileOneError.message.type = "";
    fileOneError.message.size = "";
    fileOneBorder.style.borderColor = "#009879";
  }
}

document.getElementById("valider-but").addEventListener("click", (e) => {
  var errorEle = document.getElementById("valid-error-message");
  var IsAllInfoUploaded = true;
  [fileOneInfo, fileTwoInfo].map((ele) => {
    if (ele.Isuploaded == false) {
      IsAllInfoUploaded = false;
    }
  });

  if (IsAllInfoUploaded) {
    var IsAllInfoUploadedValid = true;
    ControlleFileOneUpload();
    ControlleFileTwoUpload();
    [fileTwoError, fileTwoError].map((ele) => {
      if (ele.IsError == true) {
        IsAllInfoUploadedValid = false;
      }
      if (IsAllInfoUploadedValid) {
        errorEle.innerHTML = "";
        //get data










      } else {
        errorEle.innerHTML =
          "-veuillez télécharger les fichiers requis avec le bon type";
      }
    });
  } else {
    errorEle.innerHTML = "-veuillez télécharger les fichiers requis";
  }
});
