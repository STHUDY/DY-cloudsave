<?php
function API($name,$need,$array = array()){
    $API = json_decode(file_get_contents("./../../Config/API.json"),true);
    $request = $API[$name]["Addrass"];
    if($API[$name]["Type"] == "get"){
        if($need == true){
            $request .= "/?";
            foreach ($API[$name]["parameter"] as $key){
                if(isset($array[$key]) == true){
                    $request .= $key."=".$array[$key]."&?";
                }else{
                    $request .= $key."= &?";
                }
            }
            $request = rtrim($request,"&?");
        }
        $data = get_url($request);
        return $data;
    }
    
}

function get_url($url){
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
    $tmpInfo = curl_exec($curl);     //返回api的json对象
    //关闭URL请求
    curl_close($curl);
    return $tmpInfo;
}
?>