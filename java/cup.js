
function getName() {
  return localStorage.getItem("username");
}

function username()
{
    var name = getName();
    document.getElementById('username').innerHTML = name;
}

function calculate(){
var y = document.getElementById("cuptype").selectedIndex;
  var tsize = document.getElementsByTagName("option")[y].value;
if (tsize == "single"){
     x = 300 + 50;
}
else 
    if (tsize == "dual"){
     x = 300 + 100;
}
push_total(x);
}

function push_total(x){
    localStorage.setItem("cup_total",parseInt(x));
    localStorage.setItem("cup_occasion",document.getElementById("occasion").value);
    localStorage.setItem("cup_detail",document.getElementById("details").value);
    localStorage.setItem("image_file",document.getElementById("file").value);
}

var lastbtn = document.getElementById("payment");
lastbtn.onclick = function(){
    localStorage.setItem("object", document.getElementById("payment").value);
    calculate();
}
