function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("show");
}

function showPopup(id){
    document.getElementById(id).style.display = "block";
}

function showPopupU(category, note, amount, account, id, type, other) {
    var Popup = document.getElementById(type+"PopupU");
    document.getElementById(type+"IDU").value = id;
    if(type == "expense" || type == "income"){
        document.getElementById(type+"CategoryU").value = category;
        document.getElementById(type+"AccountU").value = account;
    }else{
        document.getElementById(type+"FromU").value = category;
        document.getElementById(type+"ToU").value = account;
    }
    document.getElementById(type+"NoteU").value = note;
    document.getElementById(type+"TotalU").value = amount;
    document.getElementById(type+"TotalUO").value = other;
    Popup.style.display = "block"; 
}

function closePopup(s) {
    var popups = document.getElementsByClassName("popup");
    for (var i = 0; i < popups.length; i++) {
        popups[i].style.display = "none";
    }
    var dropdown = document.getElementById("dropdown");
    if(s == "show"){
        dropdown.classList.toggle("show");
    }else{
        dropdown.classList.remove("show");
    }
}

function add(type){
    document.getElementById(type + "_add").action = "Content/" + type + "_add.php";
    document.getElementById(type + "_add").submit();
}

function update(type){
    document.getElementById(type + "_update").action = "Content/" + type + "_update.php";
    document.getElementById(type + "_update").submit();
}

function del(type){
    document.getElementById(type + "_update").action = "Content/" + type + "_delete.php";
    document.getElementById(type + "_update").submit();
}

function confirm(event,type){
    event.preventDefault();
    document.getElementById("confirm" + type).style.display = "block";
}

function category(type){
    document.getElementById("category" + type).style.display = "block";
}

function clickCategory(c,s,type1,type2){
    if(s == "ADD"){
        document.getElementById(type1 + "Category").value = c;
        document.getElementById("category" + type2).style.display = "none";
    }else{
        document.getElementById(type1 + "CategoryU").value = c;
        document.getElementById("category" + type2 + "U").style.display = "none";
    }
}

function categoryU(type){
    document.getElementById("category" + type + "U").style.display = "block";
}

function account(s,type){
    if(s == "ADD"){
        document.getElementById("account" + type).style.display = "block";
    }else{
        document.getElementById("account" + type + "U").style.display = "block";
    }
}

function clickAccount(a,s,type1,type2){
    if(s == "ADD"){
        document.getElementById(type1 + "Account").value = a;
        document.getElementById("account" + type2).style.display = "none";
    }else{
        document.getElementById(type1 + "AccountU").value = a;
        document.getElementById("account" + type2 + "U").style.display = "none";
    }
}

function accountT(s,type){
    if(s == "ADD"){
        document.getElementById("account" + type).style.display = "block";
    }else{
        document.getElementById("account" + type + "U").style.display = "block";
    }
}

function clickAccountT(a,s,type){ 
    if(s == "ADD"){
        document.getElementById("transfer" + type).value = a;
        document.getElementById("account" + type).style.display = "none";
    }else{
        document.getElementById("transfer" + type + "U").value = a;
        document.getElementById("account" + type + "U").style.display = "none";
    }
}