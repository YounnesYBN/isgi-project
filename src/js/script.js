
var allAddOptButs = document.querySelectorAll("#btn-select")

for (let index = 0; index < allAddOptButs.length; index++) {
    const element = allAddOptButs[index];
    element.addEventListener("click",()=>{
        document.getElementById("popupCon").style.display = "flex";
    })
    
}

document.querySelector("#xbutton").addEventListener("click",()=>{
    document.getElementById("popupCon").style.display = "none";
})

document.querySelector("#addButt").addEventListener("click",()=>{
    document.getElementById("popupCon").style.display = "none";
})
