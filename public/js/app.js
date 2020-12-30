function singleSelectChangeText() {
    //Getting Value


    var selObj = document.getElementById("singleSelectTextDDJS");
    var selValue = selObj.valueOf()[selObj.selectedIndex].text;

    //Setting Value
    document.getElementById("textFieldTextJS").value = selValue;
}



