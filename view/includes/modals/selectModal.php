#popupCon{
height: 700px;
width: 100%;
position: absolute;
z-index: 1;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
background-color: rgba(128, 128, 128, 0.303);
}
#popup{
width: 50%;
height: 60%;
display: flex;
flex-direction: column;
align-items: center;
justify-content: space-between;
background-color: white;
border-radius: 5px;

}

.con:nth-child(1){
height: 15%;
display: flex;
width: 100%;
align-items: center;
justify-content: flex-end;
padding-inline-end: 5%;
}
#xbutton{
font-size: 20px;
width: 30px;
height: 50%;
background-color: transparent;
color:  red;
border-radius: 50px;
border:0px;
transition: 500ms;

}
#xbutton:hover{
box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
background-color: red;
color:white ;
transform: translateY(-5px);
}
#xbutton:active{

transform: translateY(0px);
}
.con:nth-child(2){
display: flex;
width: 100%;
height: 60%;
flex-direction: column;
align-items: center;
justify-content: space-between;
}
.con:nth-child(3){
display: flex;
width: 100%;

height: 20%;
flex-direction: column;
align-items: center;
justify-content: space-between;
}
.textAria textarea{
width: 50%;
height: 50%;
border-radius: 5px;
font-size: 20px;
padding: 5%;
outline: none;
box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

}
.textAria textarea :hover{
background-color: red;
}

#addButt{
width: 20%;
height: 50%;

}
<div id="popupCon" style="display:none;">

    <div id="popup" >
        <div class="X con">
            <button id="xbutton">
                X
            </button>
        </div>
        <div class="textAria con">
                <textarea name="" id="" >

                </textarea>
        </div>
        <div class="AddBut con">
            <button id="addButt">
                Ajouter
            </button>
        </div>
    </div>
</div>
document.querySelector(".activePopup").addEventListener("click",()=>{
document.getElementById("popupCon").style.display = "flex";
})
