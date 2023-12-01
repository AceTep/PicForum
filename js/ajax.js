function pretraga() {
    var pojam = document.getElementById("trazilica").value;
    var xhttp;
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } 
    else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
    }

    xhttp.onreadystatechange = function() {
    if (this.readyState == 4  &&  this.status == 200) {
            document.getElementById("prikaz-kategorija").innerHTML = this.responseText; 
        }
    };
   
    xhttp.open("GET", "pretraga-kategorija.php?parametar="+pojam, true);
    xhttp.send();
}

document.addEventListener("DOMContentLoaded", pretraga);