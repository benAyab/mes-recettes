var ingredients = document.getElementById("ingredients");
var nombreIngredient = document.getElementById("nombreIngredient");


function addinput(evt){
    var qteInput = document.createElement("INPUT");
    var nomIngredient = document.createElement("INPUT");
    var div = document.createElement("DIV");
    div.className = "row";

    var n = parseInt(nombreIngredient.value);
    n++;
    qteInput.type = "text";
    qteInput.value = "";
    qteInput.name = "q"+n;

    nomIngredient.type = "text";
    nomIngredient.value = "";
    nomIngredient.name = "n"+n;

    div.appendChild(qteInput);
    div.appendChild(nomIngredient);
    ingredients.appendChild(div);

    nombreIngredient.value = ""+n;

}

//function submit(){}