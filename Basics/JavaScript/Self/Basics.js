function Jump(argument) {
    window.location.href = argument;
}

function Exit_User_load(){
    setCookie("userID","",0);
    setCookie("device","",0);
    setCookie("Path","",0);
    Jump("/Home");
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
        if(document.getElementById("CHOOSEFILENAME").value == ""){
            return 0;
        }
        Object.value = "上传中..."
        Object.disabled = "disabled";
        document.getElementById("CHOOSEFILENAME").disabled = "disabled"
        document.getElementById("CLOSEUPLOADWINDOWS").disabled = "disabled"
        document.getElementById("UpLoadProgressALL").style.display = 'block'
        UpsLoadreadFile()
    }, 10);
}
function UpsLoadAXAJFile(Url) {
	if (window.ActiveXObject) {
		var xpost = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		var xpost = new XMLHttpRequest();
	}
	xpost.onreadystatechange = function() {
		if (xpost.readyState == 4) {
			if (xpost.status == 200) {
			    window.location.reload()
			}
			if (xpost.status == 413){
			    alert("文件过大!!!")
			    window.location.reload()
			}
		}
	}

	xpost.open("post", './Core/Option/GetUploadFile.php', true);
	xpost.upload.onprogress = function(evt) {
		per = ((evt.loaded / evt.total) * 100).toFixed(2);
		document.getElementById("UpLoadProgressOne").style = "width: "+per.toString()+"%"
		document.getElementById("UpLoadProgressTwo").innerHTML = per.toString() + "%"
	}
	xpost.send(Url);
}

function UpsLoadpostFile(filea) {
	var SendUrl = new FormData();
	SendUrl.append('file', document.getElementById("CHOOSEFILENAME")
		.files[0]);
	UpsLoadAXAJFile(SendUrl);
}
function UpsLoadreadFile() {
	files = document.getElementById("CHOOSEFILENAME").files;
	fisize = files[0].size;
	if (fisize > 1) {
		filea = files[0];
		UpsLoadpostFile(filea);
	}
}

function DelFile(Object){
    DelBool = confirm("确认删除:"+Object.name+" ?");
    if(DelBool == false){
        return false;
    }
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
            (success)(result);
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
    Temp = Temp + '<input type="text" autocomplete="off" class="w-50" maxlength="32" id="FileChangeName_'+Object.name+'" name="FileChangeName" value="'+Object.name+'">';
    Temp = Temp + '<button type="button" class="border-0" onclick="CloseNoChangeFileNameForm(document.getElementById(\''+Object.name+'\'),this)" style="font-size:20px;background:none">取消</button>';
    Temp = Temp + '<input type="submit" class="border-0" onclick="CloseChangeFileNameForm(this,\''+Object.name+'\')" style="font-size:20px;background:none" value="更改"></form>';
    FILENAMEButton.style.display = "none";
    FILENAME.innerHTML = FILENAME.innerHTML + Temp;
}
function CloseNoChangeFileNameForm(obj,Object){
    obj.style.display = "block";
    Object.parentNode.remove();
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
    if(getCookie("device") == "app"){
        if(decodeURIComponent(getCookie("option")) != Object.id){
            setCookie("option",encodeURIComponent(Object.id),30);
            window.location.reload();
            return false;
        }
    }
    Object.classList.add("active")
    if(decodeURIComponent(getCookie("option")) != ""){
        if(decodeURIComponent(getCookie("option")) != Object.id){
            document.getElementById(decodeURIComponent(getCookie("option"))).classList.remove("active")
        }
    }
    setCookie("option",encodeURIComponent(Object.id),30);
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
        document.getElementById("Windows").innerHTML = result;
        TEMPTEMPTEMP = result
    },true)
}
function CLOSEUPLOADWINDOWS(){
    document.getElementById("Windows").innerHTML = ""
    if(getCookie("device") == "app"){
        window.location.reload()
    }
}
function CREATEFLODER(){
    Axaj_requre("./Core/User/UserCreateFolder_Axaj.php",function (){},true)
    setTimeout(function(){
        argument = document.getElementById("User0File0List")
        Axaj_requre("./Core/User/GetFileList_Axaj.php",function (result){
            argument.innerHTML = result;
            if(getCookie("device") == "app"){
                window.location.reload();
            }
        },true)
    },100)
}
function FILECILCKEDBYUSER(Object){
    Axaj_requre("./Core/User/UserClickFile.php?File="+Object.id,function (result){
        if(result == "reflush"){
            location.reload();
            return false;
        }
        if(result != ""){
            document.getElementById("Windows").innerHTML = result;
        }
    },true)
}
function ClearWindowsMedia(){
    document.getElementById("Windows").innerHTML = ""
}