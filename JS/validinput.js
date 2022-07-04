function getvalue(){
    var i = document.getElementById("l1").value;
    checknotnum(i);
    // submit(l);
}
function checknotnum(i){
    if(i.startsWith(parseInt(i))){
        window.alert("NAME IS NOT START WITH NUMBER");
    }
    if(i.length < 1){
        window.alert("USERNAME NOT ENTERD");
    }
}
