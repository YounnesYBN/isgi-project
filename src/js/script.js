


var GlobalOptionMessage = "";
var GlobalId_user = "";
var GlobalId_element = "";

CreateCoockieIfNotExist()
SetSelectOnLoad()

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    return cookie[cookieName];
  }

function CreateCoockieIfNotExist(){
    
    if(getCookie("selectArray") != undefined){

    }else{
        var selectArray = []
        document.cookie = `selectArray=${JSON.stringify(selectArray)};expires=Thu, 18 Dec 2060 12:00:00 UTC;path=/`
    }
}

function AddSelectIntoSelectArray(id_select,id_option){
    const selectArr  = JSON.parse(getCookie("selectArray"))
    var found = false
    selectArr.forEach(element => {
        if(element.select == id_select){
            found = true ;
        }
    });
    if(found){
        selectArr.forEach(element => {
            if(element.select == id_select){
                element.option = id_option
            }
        });

    }else{
        selectArr.push({select:id_select,option:id_option})
    }

    document.cookie = `selectArray=${JSON.stringify(selectArr)};expires=Thu, 18 Dec 2060 12:00:00 UTC;path=/`
    
    
}
function findChild(element,child_val){
    var children= element.children
    var found = null
    for (let index = 0; index < children.length; index++) {
        const element = children[index];
        if(element.value == child_val){
            found= element
        }
        
    }
    return found

}

  
function SetSelectOnLoad(){
    var allSelectOnDocument = document.getElementsByName("selectComment")
    console.log(allSelectOnDocument)
    var AllCookiesSelect = JSON.parse(getCookie("selectArray"))
    
    AllCookiesSelect.map((cookiSelect)=>{
          for (let index = 0; index < allSelectOnDocument.length; index++) {
            const select = allSelectOnDocument[index];
            if(cookiSelect.select == select.id){
                var option  = findChild(select,cookiSelect.option)
                if(option != null){

                    option.selected = true ;
                }
            }
            
          }
    })
}
var allAddOptButs = document.querySelectorAll("#btn-select")
for (let index = 0; index < allAddOptButs.length; index++) {
    const element = allAddOptButs[index];
    element.addEventListener("click",(e)=>{
        document.getElementById("popupCon").style.display = "flex";
         GlobalId_element = e.target.getAttribute("id_ele")
         GlobalId_user = e.target.getAttribute("id_user")
        
        
    })  
}

window.addEventListener("scroll", (event) => {
    let scroll = this.scrollY;
    document.getElementById('popupCon').style.top =  scroll  + 'px'
});

document.getElementById("optionTextAria").addEventListener("change",(e)=>{
    GlobalOptionMessage = e.target.value
})

for (let index = 0; index < document.getElementsByName("selectComment").length; index++) {
    const element = document.getElementsByName("selectComment")[index];
    element.addEventListener("change",(e)=>{
        var value = e.target.value 
        var id_select = e.target.id 
        AddSelectIntoSelectArray(id_select,value)
        //in case you want to add function
        //...code
    })
    
}


document.querySelector("#xbutton").addEventListener("click",()=>{
    document.getElementById("popupCon").style.display = "none";
})

document.querySelector("#addButt").addEventListener("click",(e)=>{
    
    if(GlobalOptionMessage.length>0){
        AddOption(GlobalId_element,GlobalId_user,GlobalOptionMessage)
    }


    document.getElementById("popupCon").style.display = "none";
})

function AddOption(id_ele,id_user,message){
    allSelect = document.getElementsByName("selectComment")
    $.ajax({
        type: "POST",
        url: "./../app/controller/addOption.php",
        data: {addOption:"true",message:message,id_ele:id_ele,id_user:id_user},
        dataType: "json",
        success: function (response) {
            if(response.error == false){
                var newOptionVal = response.id_option
                for (let index = 0; index < allSelect.length; index++) {
                    const element = allSelect[index];
                    if(element.id == id_ele){
                        element.innerHTML += `<option selected value='${newOptionVal}'>${message}</option>` 
                    }
                    
                }
                AddSelectIntoSelectArray(id_ele,newOptionVal)
                
            }
        }
    });
}

document.getElementById("btn-valide").addEventListener("click",()=>{
    var AllInputElement = [];
    var AllTextAreaElement = document.querySelectorAll("textarea")
    var AllinputTypeNumber = document.querySelectorAll('input[type="number"]')

    for (let index = 0; index < AllTextAreaElement.length; index++) {
        const element = AllTextAreaElement[index];
        let id_ele = element.getAttribute("id_ele")
        let ele_type = "textarea"
        let ele_val = element.value
        if(id_ele != null){
            
            AllInputElement.push({id_ele:id_ele,type:ele_type,value:ele_val})
        }
    }

    for (let index = 0; index < AllinputTypeNumber.length; index++) {
        const element = AllinputTypeNumber[index];
        let id_ele = element.getAttribute("id_ele")
        let ele_type = "number"
        let ele_val = element.value
        if(id_ele != null){
            
            AllInputElement.push({id_ele:id_ele,type:ele_type,value:ele_val})
        }
        
    }

    $.ajax({
        type: "POST",
        url: "./../app/controller/updateAllInfo.php",
        data: {updateInfo:true,allElement:AllInputElement},
        dataType: "json",
        success: function (response) {
            // location.reload()
        }
    });
})
