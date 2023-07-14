var f=0;
let tabletime=[];
function j30_fct(){
    eletitre=document.getElementById("titre");
    var gottitre=eletitre.getAttribute("value");
    eleadress=document.getElementById("adress");
    var gotadress=eleadress.getAttribute("value");
    if(eletitre.getAttribute("value") && eleadress.getAttribute("value")){
        t={};t["indice"]=f;t["titre"]=gottitre;t["adress"]=gotadress;t["status"]="Unexpired";
        f++;
        tabletime=tabletime.concat(t);

        ele1=document.getElementById("valid");

        setTimeout(expired_fct(f),1000*60*24*30,"Nevermind #YassineK.O#");
    }
}
function expired_fct(f) {
    for(let i=0;i<tabletime[0].length;i++){
        if(tabletime[i]["indice"]===f)
            tabletime[i]["status"]="Expired";
    }
}

