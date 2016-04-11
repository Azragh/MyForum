var rq;

function getRegisterForm(){
    rq = new XMLHttpRequest();
    rq.open("post", "register.php", true);
    rq.send( null );
    rq.onreadystatechange = placeForm;
}

function placeForm(){
    if(rq.readyState == 4 && rq.status == 200){
        document.getElementById("formcontainer").innerHTML = rq.responseText;
    }
}
