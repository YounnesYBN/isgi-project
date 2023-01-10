<style>

    table {
        border-collapse: collapse;
        margin: 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        width: 98%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    table th,
    table td {
        padding: 12px 15px;
        border: 1px solid black;
    }

    table tbody tr {
        border-bottom: 1px solid #dddddd;
    }


    table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    table tr td:nth-child(2) , table tr td:nth-child(3){
        padding: 0;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number]{
        width:98%;
        font-size: 18px;
        height: 46px;
        margin: 0;
        border: none;
        outline: none;
        text-align: center;
        background: transparent;

    }

    thead tr th{
        text-align: center;
    }


    thead tr th:nth-child(1){
        width: 140px;

    }



    thead tr th:nth-child(2){
        width: 390px;

    }

    thead tr th:nth-child(3){
        width: 84px;

    }


    /* commentaires style*/

    tr td select{
        width: 70%;
        height: 35px;
        border-radius: 5px;
        margin-left: 10px;
        box-sizing: border-box;
        padding-left: 5px;
        outline: none;
        text-align: center;
        cursor: pointer;
    }
    tr td select option{
        background-color: #072e55;
        color: #fff;
    }

    tr td #btn-select{
        width: 25%;
        min-width: 100px;
        height: 35px;
        border-radius: 5px;
        margin: 3px;
        box-sizing: border-box;
        padding-left: 5px;
        outline: none;
        text-align: center;
        border: none;
        cursor: pointer;
    }
    tr td #btn-select:hover{
        border: 2px solid #009879;
    }

    #textComment{
        margin: 0;
        height: fit-content;
        border: none;
        width: 98%;
        border: none;
        outline: none;
        padding: 5px;
        font-size: 16px;
    }


    /*Modal style*/

    #popupCon{
        height: 100vh;
        width: 100%;
        position: absolute;
        z-index: 99;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    #popup{
        position: relative;
        width: 80%;
        height: 60%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        background-color: rgba(10, 3, 3, 0.3);
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
        font-weight: bold;
        width: 30px;
        height: 50%;
        background-color: #009879;
        color:  #072e55;
        border-radius: 10px;
        transition: 500ms;
    border: none;

    }
    #xbutton:hover{
        background-color: #072e55;
        color:white ;
        cursor: pointer;
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
        width: 85%;
        height: 80%;
        border-radius: 5px;
        font-size: 15px;
        padding: 5px 10px;
        outline: none;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

    }


    #addButt{
        width: 20%;
        height: 50%;

    }

    header{
        justify-content: space-around;
    }

    header form button{

        height: 40px;
        background-color: #009879;
        color: #ffffff;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    header form button:hover{
        background-color: #006c57;
    }

    .btnDiv{
        margin: 10px;
        width: 100%;
        height: 200px;
        display: flex;
        justify-content: center;
        align-content: center;

    }

    #btn-valide {
        height: 40px;
        width: 120px;
        background-color: #009879;
        color: #ffffff;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin: 80px 0;
    }

    #btn-valide:hover{
        background-color: #006c57;
    }




</style>
