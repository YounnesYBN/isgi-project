var allInfoOne;

//-----------------------------------------
var allInfoTwo;

//----------------------------------------
var all_codeEFP_distinct = [];

var finallArray = [];
//-------------------------------------------------------
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
    });
    if (IsAllInfoUploadedValid) {
      errorEle.innerHTML = "";
      //get data

      //get codeEFP distinct and for each codeEFP it's ville and complexe {codeEFP : ,info:{ville:,complexe:},filier:[]}
      Get_CodeEFP_distinct();
      //get foreach codeEFP filier distinct and for each filier it's code_filier, numGroup, year and Metiers {code_filier:,year:,numGroup:,metiers:[]}
      Get_for_each_CodeEFP_filier_distinct();
      Get_for_each_filier_Metiers_distinct_with_hour();
      update_metier_hour_by_numGroup();
      sumUp_doublicated_metier_foreach_filier();
      distinct_filier_foreach_codeEFP();
      sumUp_doublicated_metier_foreach_complex();
      sumUp_doublicated_metier_by_ville_and_complex()
      exportFile()

      console.log(finallArray);
    } else {
      errorEle.innerHTML =
        "-veuillez télécharger les fichiers requis avec le bon type";
    }
  } else {
    errorEle.innerHTML = "-veuillez télécharger les fichiers requis";
  }
});

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

function Get_CodeEFP_distinct() {
  allInfoTwo.map((line) => {
    var found = false;
    var ville = line["Ville"];
    var Complexe = line["Complexe"];
    all_codeEFP_distinct.map((ele) => {
      if (ele.codeEFP == line["CodeEFP"]) {
        found = true;
      }
    });

    if (!found) {
      all_codeEFP_distinct.push({
        codeEFP: line["CodeEFP"],
        info: { ville: ville, complexe: Complexe },
        filiers: [],
      });
    }
  });
}

function Get_for_each_CodeEFP_filier_distinct() {
  all_codeEFP_distinct.map((ele1) => {
    allInfoTwo.map((line) => {
      if (line["CodeEFP"] == ele1.codeEFP) {
        var exel_code_filier = line["Code filiére"];
        var year = line["Année de formation"];
        var numGroup = line[" Nbre Groupe 22-23 Réalisé"];
        var found = false;

        //see if filier already exists
        ele1.filiers.map((filier) => {
          if (filier.code_filier == exel_code_filier && filier.year == year) {
            found = true;
          }
        });

        //push new filier with it's information if not exists
        if (!found) {
          ele1.filiers.push({
            code_filier: exel_code_filier,
            year: year,
            numGroup: numGroup,
            Metiers: [],
          });
        }
      }
    });
  });
}

function Get_for_each_filier_Metiers_distinct_with_hour() {
  all_codeEFP_distinct.map((ele) => {
    ele.filiers.map((filier) => {
      allInfoOne.map((line) => {
        if (
          filier.code_filier == line["Code Filière Carte"] &&
          filier.year == line["Anneé de Formation"]
        ) {
          var mitier = line["Métier"];
         
          var hour = line["MHT"];
          filier.Metiers.push({ name: mitier&&mitier.toUpperCase(), hour: hour });
        }
      });
    });
  });
}

function update_metier_hour_by_numGroup() {
  all_codeEFP_distinct.map((ele) => {
    ele.filiers.map((filier) => {
      filier.Metiers.map((metier) => {
        metier.hour = metier.hour * filier.numGroup;
      });
    });
  });
}

function sumUp_doublicated_metier_foreach_filier() {
  all_codeEFP_distinct.map((ele) => {
    ele.filiers.map((filier) => {
      var array = [];
      filier.Metiers.map((mitier) => {
        var found = false;
        var ele_index = null;
        array.map((mitier2, index) => {
          if (mitier.name == mitier2.name) {
            found = true;
            ele_index = index;
          }
        });
        if (found) {
          array[ele_index].hour += mitier.hour;
        } else {
          array.push(mitier);
        }
      });
      filier.Metiers = array;
    });
  });
}

function distinct_filier_foreach_codeEFP() {
  all_codeEFP_distinct.map((ele) => {
    var array = [];
    ele.filiers.map((filier) => {
      var found = false;
      var dis_fil_index = null;
      array.map((dis_filier, index) => {
        if (filier.code_filier == dis_filier.code_filier) {
          found = true;
          dis_fil_index = index;
        }
      });
      //if filier exists or not
      if (found) {
        filier.Metiers.map((mitier) => {
          var found2 = false;
          var index2 = null;
          array[dis_fil_index].Metiers.map((mitier2, index) => {
            if (mitier.name == mitier2.name) {
              found2 = true;
              index2 = index;
            }
          });
          if (found2) {
            array[dis_fil_index].Metiers[index2].hour += mitier.hour;
          } else {
            array[dis_fil_index].Metiers.push(mitier);
          }
        });
      } else {
        array.push({
          code_filier: filier.code_filier,
          Metiers: filier.Metiers,
        });
      }
    });
    ele.filiers = array;
  });
}

function sumUp_doublicated_metier_foreach_complex() {
  all_codeEFP_distinct.map((ele) => {
    var array = [];
    ele.filiers.map((filier) => {
      filier.Metiers.map((metier) => {
        var found = false;
        var ele_index = null;
        array.map((mitierDis, index) => {
          if (mitierDis.name == metier.name) {
            found = true;
            ele_index = index;
          }
        });
        if (found) {
          array[ele_index].hour += metier.hour;
        } else {
          array.push(metier);
        }
      });
    });
    ele.finalResult = array;
  });
}

function sumUp_doublicated_metier_by_ville_and_complex() {
  all_codeEFP_distinct.map((ele) => {
    const { complexe, ville } = ele.info;
    var found = false;
    var ele_index = null;
    finallArray.map((final_ele,index)=>{
      if(final_ele.complexe == complexe && final_ele.ville == ville){
        found = true;
        ele_index = index
      }
    })
    if(found){
      ele.finalResult.map(metier=>{
        var found2 = false;
        var ele_index2 = null
        finallArray[ele_index].Metiers.map((metier2,index)=>{
          if(metier.name == metier2.name){
            found2 = true;
            ele_index2 = index
          }
        })

        if(found2){
          finallArray[ele_index].Metiers[ele_index2].hour += metier.hour
        }else{
          finallArray[ele_index].Metiers.push(metier)
        }
      })
      
    }else{
      finallArray.push({complexe : complexe , ville: ville ,Metiers: ele.finalResult})
    }
  });
}

function exportFile() {
  var allData = [];
  finallArray.map((ele) => {
    const { complexe, ville, Metiers } = ele;
    Metiers.map((model) => {
      const { name, hour } = model;
      allData.push({
        cle: complexe + ville + name,
        complexe: complexe,
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
