var allInfoOne;

//-----------------------------------------
var allInfoTwo;

//----------------------------------------
var allFilierDistictWithModels = [];
var allFilierWithModelsOnAllYears = [];
var allCodeEFPandcode_filier = [];
var allfilierExistsInFile1andFile2 = [];
var finallArray = [];
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
    GetDataFileTwo();
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
    GetDataFileOne();
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

        GetallFilierDistict();
        GetAllModulesWithHours();
        GetallFilierWithModelsOnAllYears();
        GetallCodeEFPandcode_filier();
        GetForEachFilierCodeEFP();
        //   console.log(allCodeEFPandcode_filier);
        GetGroupallModelsByCodeEFP();
        console.log(finallArray);
        exportFile();
      } else {
        errorEle.innerHTML =
          "-veuillez télécharger les fichiers requis avec le bon type";
      }
    });
  } else {
    errorEle.innerHTML = "-veuillez télécharger les fichiers requis";
  }
});

function GetallFilierDistict() {
  allInfoOne.map((line) => {
    let code_filier = line["Code Filière Carte"];
    let year = line["Anneé de Formation"];
    found = false;
    allFilierDistictWithModels.map((ele) => {
      if (ele.code_filier == code_filier && ele.info.year == year) {
        found = true;
      }
    });
    if (!found) {
      allFilierDistictWithModels.push({
        code_filier: code_filier,
        info: { year: year },
      });
    }
  });
}

function GetDataFileOne() {
  selectedFileOne = fileOneInfo.selectedFile;
  if (selectedFileOne) {
    let fileReader = new FileReader();
    fileReader.readAsBinaryString(selectedFileOne);
    fileReader.onload = (event) => {
      let data = event.target.result;
      let workbook = XLSX.read(data, { type: "binary" });
      let rowObject = XLSX.utils.sheet_to_row_object_array(
        workbook.Sheets[workbook.SheetNames[0]]
      );
      //get All required data
      allInfoOne = rowObject;
    };
  }
}

function GetDataFileTwo() {
  selectedFileTwo = fileTwoInfo.selectedFile;
  if (selectedFileTwo) {
    let fileReader = new FileReader();
    fileReader.readAsBinaryString(selectedFileTwo);
    fileReader.onload = (event) => {
      let data = event.target.result;
      let workbook = XLSX.read(data, { type: "binary" });
      let rowObject = XLSX.utils.sheet_to_row_object_array(
        workbook.Sheets[workbook.SheetNames[0]]
      );
      //get All required data
      allInfoTwo = rowObject;
    };
  }
}
function GetAllModulesWithHours() {
  allFilierDistictWithModels.map((ele) => {
    var modelArray = [];
    allInfoOne.map((line) => {
      var code_filier1 = line["Code Filière Carte"];
      var year1 = line["Anneé de Formation"];
      if (code_filier1 == ele.code_filier && year1 == ele.info.year) {
        modelArray.push({
          name: line["Métier"],
          hour: parseInt(line["MHT"]),
        });
      }
    });
    ele.info.models = modelArray;
  });
}

function GetallFilierWithModelsOnAllYears() {
  allFilierDistictWithModels.map((array1) => {
    var found = false;
    allFilierWithModelsOnAllYears.map((array2) => {
      if (array2.code_filier == array1.code_filier) {
        found = true;
      }
    });

    if (found) {
      allFilierWithModelsOnAllYears.map((array2) => {
        if (array2.code_filier == array1.code_filier) {
          if (!array2.years.includes(array1.info.year)) {
            array2.years.push(array1.info.year);
            array1.info.models.map((model1) => {
              var found2 = false;

              array2.allModels.map((model2) => {
                if (model1.name == model2.name) {
                  found2 = true;
                }
              });
              if (found2) {
                array2.allModels.map((model2) => {
                  if (model1.name == model2.name) {
                    model2.hour += model1.hour;
                  }
                });
              } else {
                array2.allModels.push(model1);
              }
            });
          }
        }
      });
    } else {
      var yearArray = [];
      yearArray.push(array1.info.year);
      allFilierWithModelsOnAllYears.push({
        code_filier: array1.code_filier,
        years: yearArray,
        allModels: [].concat(array1.info.models),
      });
    }
  });
}

function GetallCodeEFPandcode_filier() {
  allInfoTwo.map((line) => {
    found = false;
    allCodeEFPandcode_filier.map((ele) => {
      if (
        line["CodeEFP"] == ele.codeEFP &&
        line["Code filiére"] == ele.code_filier
      ) {
        found = true;
      }
    });
    if (!found) {
      allCodeEFPandcode_filier.push({
        codeEFP: line["CodeEFP"],
        code_filier: line["Code filiére"],
        complex: line["Complexe"],
        ville: line["Ville"],
      });
    }
  });
}

function GetForEachFilierCodeEFP() {
  allFilierWithModelsOnAllYears.map((ele1) => {
    var codeEFP = null;
    var element1 = ele1;
    var complex = null;
    var ville = null;
    var found = false;
    allCodeEFPandcode_filier.map((ele2) => {
      if (ele2.code_filier == element1.code_filier) {
        found = true;
        codeEFP = ele2.codeEFP;
        complex = ele2.complex;
        ville = ville;
      }
    });
    if (found) {
      element1.codeEFP = codeEFP;
      element1.complex = complex;
      element1.ville = ville;
      allfilierExistsInFile1andFile2.push(element1);
    }
  });
}

function GetGroupallModelsByCodeEFP() {
  allCodeEFPandcode_filier.map((array1) => {
    var BigCodeEFP = array1.codeEFP;
    var complex = array1.complex;
    var ville = array1.ville;
    var modelsArray = [];
    var found = false;
    finallArray.map((x) => {
      if (x.codeEFP == BigCodeEFP) {
        found = true;
      }
    });

    if (!found) {
      allfilierExistsInFile1andFile2.map((array2) => {
        if (array2.codeEFP == BigCodeEFP) {
          array2.allModels.map((mode1) => {
            var found2 = false;
            modelsArray.map((mode2) => {
              if (mode1.name == mode2.name) {
                found2 = true;
              }
            });

            if (found2) {
              modelsArray.map((mode2) => {
                if (mode1.name == mode2.name) {
                  mode2.hour += mode1.hour;
                }
              });
            } else {
              modelsArray.push(mode1);
            }
          });
        }
      });
      finallArray.push({
        complex: complex,
        ville: ville,
        codeEFP: BigCodeEFP,
        allmodels: modelsArray,
      });
    }
  });
}

function exportFile() {
  var allData = [];
  finallArray.map((ele) => {
    const { complex, ville, allmodels } = ele;
    allmodels.map((model) => {
      const { name, hour } = model;
      allData.push({
        cle: complex + ville + name,
        complexe: complex,
        ville: ville,
        "Métier global": name,
        "Besoin Total en heure": hour,
      });
    });
  });

  filename = "exportedFile.xlsx";

  var ws = XLSX.utils.json_to_sheet(allData);
  var wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "sheet1");
  XLSX.writeFile(wb, filename);
}
