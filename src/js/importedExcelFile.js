var ErrorMessage = { input: "", file: "" };
var inputError = { error: false, max: 0, min: 0 };
let Error = { error: false };
var AllData = [
  { id_ele: 1, val: 0 },
  { id_ele: 2, val: 0 },
  { id_ele: 39, val: 0 },
  { id_ele: 40, val: 0 },
  { id_ele: 41, val: 0 },
  { id_ele: 42, val: 0 },
  { id_ele: 43, val: 0 },
  { id_ele: 14, val: 0 },
  { id_ele: 15, val: 0 },
  { id_ele: 16, val: 0 },
  { id_ele: 17, val: 0 },
  { id_ele: 18, val: 0 },
  { id_ele: 19, val: 0 },
];
var selectedFileInfo = { name: "", size: 0 };
var selectedFile;
var allInfo;
var AllGroupDistinct = [];
var AllmoduleDistinct = [];
var AllmoduleGroupDistinct = [];
var AllmoduleGroupedByGroup = [];
var AllFilierDistinct = [] ;
var AllGroupeGroupedByFilier = [];
let data = [
  {
    name: "jayanth",
    data: "scd",
    abc: "sdef",
  },
];

document.getElementById("fileHolder").addEventListener("change", (event) => {
  selectedFileInfo.name = event.target.files[0].name;
  selectedFileInfo.size = event.target.files[0].size;
  selectedFile = event.target.files[0];
  ControlleFileOnUpload();
});

function ControlleFileOnUpload() {
  let namefile = selectedFileInfo.name;
  let sizefile = selectedFileInfo.size;
  let spileFilearray = namefile.split(".");
  let filetype = spileFilearray[spileFilearray.length - 1];

  if ((filetype != "xlsx" && filetype != "xls") || sizefile > 5_000_000) {
    Error.error = true;
    ErrorMessage.file =
      "-Le type de fichier n'est pas pris en charge ou Le fichier est trop gros (Plus De 5Mb) pour être téléchargé";

    document.getElementById("message").innerHTML = [
      ErrorMessage.file,
      ErrorMessage.input,
    ].join("<br>");
    document.getElementById("message").style.color = "red";
    document.querySelector(".custom-file-upload").style.borderColor = "red";
  } else {
    Error.error = false;
    ErrorMessage.file = "";

    document.querySelector(".custom-file-upload").style.borderColor = "#009879";
    document.getElementById("message").innerHTML = "";
  }
}

function controleInput() {
  max = document.getElementById("max_inp").value;
  min = document.getElementById("min_inp").value;
  if (max > 0 && min > 0 && max > min) {
    inputError.error = false;
    ErrorMessage.input = "";
    inputError.max = max;
    inputError.min = min;
  } else {
    inputError.error = true;
    ErrorMessage.input = "-Entrez des valeurs correctes";
    document.getElementById("max_inp").style.borderColor = "red";
    document.getElementById("min_inp").style.borderColor = "red";
    document.getElementById("message").innerHTML = [
      ErrorMessage.file,
      ErrorMessage.input,
    ].join("<br>");
    document.getElementById("message").style.color = "red";
  }
}

document.getElementById("btn-ok").addEventListener("click", (e) => {
  controleInput();

  if (selectedFileInfo.size == 0) {
    document.querySelector(".custom-file-upload").style.borderColor = "red";
  } else {
    if (!Error.error && !inputError.error) {
      XLSX.utils.json_to_sheet(data, "out.xlsx");
      if (selectedFile) {
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);
        fileReader.onload = (event) => {
          let data = event.target.result;
          let workbook = XLSX.read(data, { type: "binary" });
          let rowObject = XLSX.utils.sheet_to_row_object_array(
            workbook.Sheets[workbook.SheetNames[0]]
          );
          //get All required data
          allInfo = rowObject;
          GetAllFilierDistict();
          GetAllGroupByFilier();
          GetGroupDistainct();
          GetModuleDistinct();
          GetModuleGroupDistinct();
          GetAllModuleGroupedByGroup();
          GetNumTotaleGroupeValides();
          // set all data
          setVal(1, AllGroupDistinct.length);
          setVal(2, GetNumTotaleGroupeValides());
          setVal(39, AllGroupDistinct.length);
          setVal(
            40,
            returnMoiConFai(
              TauxGroupes(),
              parseFloat(inputError.max),
              parseFloat(inputError.min)
            ).convonable
          );
          setVal(
            41,
            returnMoiConFai(
              TauxGroupes(),
              parseFloat(inputError.max),
              parseFloat(inputError.min)
            ).moyen
          );
          setVal(
            42,
            returnMoiConFai(
              TauxGroupes(),
              parseFloat(inputError.max),
              parseFloat(inputError.min)
            ).faible
          );
          setVal(
            43,
            returnMoiConFai(
              TauxGroupes(),
              parseFloat(inputError.max),
              parseFloat(inputError.min)
            ).convonable +
              returnMoiConFai(
                TauxGroupes(),
                parseFloat(inputError.max),
                parseFloat(inputError.min)
              ).moyen
          );
          setVal(14, AllmoduleDistinct.length);
          setVal(15, GetNumberModuleAcheves());
          setVal(16, GetNumberEFMStatus().EFMlocal);
          setVal(17, GetNumberEFMStatus().EFMregional);
          setVal(18, GetNumberEFMStatus().EFMlocalRialiser);
          setVal(19, GetNumberEFMStatus().EFMregionalRialiser);

          // $.ajax({
          //   type: "POST",
          //   url: "./../app/controller/SetDataAfterUpload.php",
          //   data: { setData: true, dataArray: AllData },
          //   dataType: "JSON",
          //   success: function (response) {
          //     if (response.error == false) {
          //       // location.href = "./home.php";
          //     } else {
          //       alert(
          //         "Il y a un problème inconnu. Rechargez la page et saisissez soigneusement les informations"
          //       );
          //     }
          //   },
          // });
        };
      }
    }
  }
});

////////////////////////////////////////////////////////////////// all functions ///////////////////////////////////////////////

function GetAllFilierDistict(){
  allInfo.forEach(element=>{
    if(!AllFilierDistinct.includes(element["Code Filière"])){
      AllFilierDistinct.push(element["Code Filière"])
    }
  })
  console.log(AllFilierDistinct)
}
function GetAllGroupByFilier(){
  AllFilierDistinct.forEach(filier=>{
    let groupArray = [];
    allInfo.forEach(line=>{

      if(line["Code Filière"] == filier){

        AllGroupeGroupedByFilier.forEach(filier2=>{

          if(filier == filier2.filier){

            if(!filier2.groups.includes(line.Groupe)){
              groupArray.push(line.Groupe)
            }
          }

        })
      }
    })
    AllGroupeGroupedByFilier.push({filier:filier,groups:groupArray})
  })

  console.log(AllGroupeGroupedByFilier)
}

function GetAllModuleGroupedByGroup() {
  //return an array contains object each object have a group and module array grouped by that groupe and thier taux
  AllGroupDistinct.forEach((group) => {
    let moduleArray = [];
    allInfo.forEach((element) => {
      if (element.Groupe == group) {
        moduleArray.push({
          modul: element["Module"],
          taux: element["Taux Réalisation (P & SYN )"],
        });
      }
    });
    AllmoduleGroupedByGroup.push({ groupName: group, AllModule: moduleArray });
  });
}

function GetNumTotaleGroupeValides() {
  let Totalvalider = 0;
  AllmoduleGroupedByGroup.forEach((GroupModule) => {
    let countModuleAch = 0;
    GroupModule.AllModule.forEach((module) => {
      if (module.taux >= 95) {
        countModuleAch += 1;
      }
    });
    if (countModuleAch == GroupModule.AllModule.length) {
      Totalvalider += 1;
    }
  });

  return Totalvalider;
}

function setVal(id_ele, newValue) {
  AllData.forEach((element) => {
    if (element.id_ele == id_ele) {
      element.val = newValue;
    }
  });
}

function GetGroupDistainct() {
  allInfo.forEach((line) => {
    let group = line.Groupe;
    if (!AllGroupDistinct.includes(group)) {
      //returns an array with all groups names distinct
      AllGroupDistinct.push(group);
    }
  });
}

function GetModuleDistinct() {
  allInfo.forEach((line) => {
    let module = line.Module;
    if (!AllmoduleDistinct.includes(module)) {
      //returns an array with all modules names distinct
      AllmoduleDistinct.push(module);
    }
  });
}

// function GetTauxRealiserModule(){
//     let x = []
//     AllmoduleDistinct.forEach(module=>{                     //
//         let Totale = 0
//             allInfo.forEach(line=>{
//                 if(line.Module == module && line["Taux Réalisation (P & SYN )"]!= undefined){

//                     Totale += parseFloat(line["Taux Réalisation (P & SYN )"])
//                 }
//             })
//         x.push[{module:module,tauxRealiser:Totale}]
//     })

//     return x ;
// }

function GetMHRealiserGlobale(group) {
  let total = 0; //returns total of MHRealiserGlobale depanding on group name that is given in parameter
  allInfo.forEach((element) => {
    if (
      element["Groupe"] == group &&
      element["MH Réalisée Globale"] != undefined
    ) {
      total += parseFloat(element["MH Réalisée Globale"]);
    }
  });
  return total;
}
function GetModuleGroupDistinct() {
  allInfo.forEach((line) => {
    let group = line["Groupe"];
    let module = line["Module"];
    let taux = line["Taux Réalisation (P & SYN )"];
    let regional = line["Régional"];
    let pass = line["Séance EFM"];
    let found = false;

    AllmoduleGroupDistinct.forEach((couple) => {
      if (couple.module == module && couple.groupe == group) {
        //returns an array of object that is contains  all groups and module names distinct and thier taux
        found = true;
      }
    });

    if (!found) {
      AllmoduleGroupDistinct.push({
        module: module,
        groupe: group,
        taux: taux,
        Regional: regional == "N" ? false : true,
        pass: pass == "Non" ? false : true,
      });
    }
  });
}

function GetMHAffectéeGlobale(group) {
  ////returns total of MHAffectéeGlobale depanding on group name that is given in parameter
  let total = 0;
  allInfo.forEach((element) => {
    if (
      element["Groupe"] == group &&
      element["MH Affectée Globale (P & SYN)"] != undefined
    ) {
      total += parseFloat(element["MH Affectée Globale (P & SYN)"]);
    }
  });
  return total;
}

function TauxGroupes() {
  let storeGroupTaux = [];

  AllGroupDistinct.forEach((element) => {
    if (GetMHAffectéeGlobale(element) != 0) {
      //returns an array with objects that contains group name and its taux by using two functions

      let taux =
        (GetMHRealiserGlobale(element) / GetMHAffectéeGlobale(element)) * 100;
      storeGroupTaux.push({ group: element, taux: Math.ceil(taux) });
    } else {
      storeGroupTaux.push({ group: element, taux: 0 });
    }
  });

  return storeGroupTaux;
}

function returnMoiConFai(taux_array, max, min) {
  //returns an object that contains how many groups that are convonabl,moyen and faible from and array that is given in para
  var x = { moyen: 0, convonable: 0, faible: 0 };

  taux_array.forEach((element) => {
    if (element.taux < min) {
      x.faible += 1;
    } else {
      if (element.taux < max) {
        x.moyen += 1;
      } else {
        x.convonable += 1;
      }
    }
  });
  return x;
}

function GetNumberModuleAcheves() {
  let count = 0;
  AllmoduleGroupDistinct.forEach((element) => {
    if (element.taux >= 95) {
      count++;
    }
  });
  return count;
}

function GetNumberEFMStatus() {
  let status = {
    EFMlocal: 0,
    EFMregional: 0,
    EFMlocalRialiser: 0,
    EFMregionalRialiser: 0,
  };

  AllmoduleGroupDistinct.forEach((element) => {
    if (element.Regional == true) {
      if (element.pass == true) {
        status.EFMregionalRialiser += 1;
      } else {
        status.EFMregional += 1;
      }
    } else {
      if (element.pass) {
        status.EFMlocalRialiser += 1;
      } else {
        status.EFMlocal += 1;
      }
    }
  });

  return status;
}
