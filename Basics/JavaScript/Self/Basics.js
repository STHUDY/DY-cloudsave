function Jump(argument) {
    window.location.href = argument
}

function Exit_User_load(){
    setCookie("userID","",0);
    Jump("/Home")
}
function getCookie(cname)
{
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
    if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
  return "";
}
function UpLoadUserFiles(Object){
    setTimeout(function() {
        Object.value = "上传中..."
        Object.disabled = "disabled";
        document.getElementById("CLOSEUPLOADWINDOWS").disabled = "disabled"
    }, 10);
}
function DelFile(Object){
    Axaj_requre("./Core/User/UserDelFile_Axaj.php?name=" + Object.name,
    function (result){
        argument = document.getElementById("User0File0List");
        Axaj_requre("./Core/User/GetFileList_Axaj.php",function (result){
            argument.innerHTML = result;
        },true)
    },true)
}
function setCookie(cname,cvalue,exdays)
{
  var d = new Date();
  d.setTime(d.getTime()+(exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}
function ChangeLeftName(){
    
}
function Axaj_requre(address,success,type){
    var xmlhttp;
    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
        
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            result=xmlhttp.responseText;
            (success)(result)
        }
    }
    xmlhttp.open("GET",address,type);
    xmlhttp.send();
}
function ChangeFileName(Object){
    FILENAME = document.getElementById("SHOWFILEXXNAME_"+Object.name);
    FILENAMEButton = document.getElementById(Object.name);
    if(FILENAMEButton.style.display == "none"){
        return false;
    }
    Temp = '<form action="./Core/User/ChangeUserFileName.php?File='+Object.name+'" method="post" class="needs-validation h-100" target="form-submit" style="margin-bottom:0">';
    Temp = Temp + '<input type="text" class="w-50" maxlength="32" id="FileChangeName_'+Object.name+'" name="FileChangeName" value="'+Object.name+'">';
    Temp = Temp + '<button type="submit" class="border-0" onclick="CloseNoChangeFileNameForm(document.getElementById(\''+Object.name+'\'),this)" style="font-size:20px;background:none">取消</button>';
    Temp = Temp + '<input type="submit" class="border-0" onclick="CloseChangeFileNameForm(this,\''+Object.name+'\')" style="font-size:20px;background:none" value="更改"></form>'
    FILENAMEButton.style.display = "none";
    FILENAME.innerHTML = FILENAME.innerHTML + Temp;
}
function CloseNoChangeFileNameForm(obj,Object){
    obj.style.display = "block";
    Object.parentNode.remove()
}
function CloseChangeFileNameForm(Object,name){
    setTimeout(function(){
        console.log("DelFileNAME_"+name)
        console.log(document.getElementById("DelFileNAME_"+name).id)
        FILENAMEButton = document.getElementById(name);
        FILENAMEButton.style.display = "block";
        FILENAMEButton.innerHTML = FILENAMEButton.innerHTML.replace(name,document.getElementById("FileChangeName_"+name).value)
        FILENAMEButton.id = document.getElementById("FileChangeName_"+name).value
        document.getElementById("SHOWFILEXXNAME_"+name).id = "SHOWFILEXXNAME_" + document.getElementById("FileChangeName_"+name).value
        document.getElementById("DOWNLOADFILE_"+name).href = document.getElementById("DOWNLOADFILE_"+name).href.replace(encodeURI(name),document.getElementById("FileChangeName_"+name).value)
        document.getElementById("DOWNLOADFILE_"+name).id = "DOWNLOADFILE_"+document.getElementById("FileChangeName_"+name).value
        document.getElementById("DelFileNAME_"+name).name = document.getElementById("FileChangeName_"+name).value
        document.getElementById("DelFileNAME_"+name).id = "DelFileNAME_"+document.getElementById("FileChangeName_"+name).value
        document.getElementById("CHANGENAME_"+name).name = document.getElementById("FileChangeName_"+name).value
        document.getElementById("CHANGENAME_"+name).id = "CHANGENAME_" + document.getElementById("FileChangeName_"+name).value
        Object.name = document.getElementById("FileChangeName_"+name).value
        document.getElementById("FileChangeName_"+name).id = "FileChangeName_" + document.getElementById("FileChangeName_"+name).value
        Object.parentNode.remove();
    },100)
}
function LeftOptionClieked(Object){
    Object.classList.add("active")
    if(getCookie("option") != ""){
        if(getCookie("option") != Object.id){
            document.getElementById(getCookie("option")).classList.remove("active")
        }
    }
    setCookie("option",Object.id,30)
    setTimeout(function(){
        argument = document.getElementById("User0File0List")
        Axaj_requre("./Core/User/GetFileList_Axaj.php",function (result){
            argument.innerHTML = result;
        },true)
    },100)
}
var TEMPTEMPTEMP="";
function OPENUPLOADWINDOWS(){
    Axaj_requre("./Core/User/UploadFile_Axaj.php",function (result){
        document.body.innerHTML = document.body.innerHTML + result;
        TEMPTEMPTEMP = result
    },true)
}
function CLOSEUPLOADWINDOWS(){
    document.getElementById("SHOWUPLOADWINDOWS").remove()
}
function CREATEFLODER(){
    Axaj_requre("./Core/User/UserCreateFolder_Axaj.php",function (){},true)
    setTimeout(function(){
        argument = document.getElementById("User0File0List")
        Axaj_requre("./Core/User/GetFileList_Axaj.php",function (result){
            argument.innerHTML = result;
        },true)
    },100)
}
function FILECILCKEDBYUSER(Object){
    Axaj_requre("./Core/User/UserClickFile.php?File="+Object.id,function (result){
        if(result == "reflush"){
            location.reload();
            
        }
        if(result != ""){
            document.body.innerHTML = document.body.innerHTML + result;
        }
    },true)
}