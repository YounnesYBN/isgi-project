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

    table thead th {

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
        margin: 0;
        box-sizing: border-box;
        padding-left: 5px;
        outline: none;
        text-align: center;
        border: 1px solid #072e55;
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
        border: 1px solid rgb(7, 46, 85);
        cursor: pointer;
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



</style>
