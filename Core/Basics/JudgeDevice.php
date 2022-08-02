<?php
$Core_Basics_JudgeDevice_Result = false;
$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
    $Core_Basics_JudgeDevice = '0';  
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
        $Core_Basics_JudgeDevice++;  
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
        $Core_Basics_JudgeDevice++;  
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
        $Core_Basics_JudgeDevice++;  
    if(isset($_SERVER['HTTP_PROFILE']))  
        $Core_Basics_JudgeDevice++;  
    $Core_Basics_JudgeDevice_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
    $Core_Basics_JudgeDevice_agents = array(  
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
        'wapr','webc','winw','winw','xda','xda-'
        );  
    if(in_array($Core_Basics_JudgeDevice_ua, $Core_Basics_JudgeDevice_agents))  
        $Core_Basics_JudgeDevice++;  
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
        $Core_Basics_JudgeDevice++;  
    // Pre-final check to reset everything if the user is on Windows  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
        $Core_Basics_JudgeDevice=0;  
    // But WP7 is also Windows, with a slightly different characteristic  
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
        $Core_Basics_JudgeDevice++;  
    if($Core_Basics_JudgeDevice>0)  
        $Core_Basics_JudgeDevice_Result = true;  
    else
        $Core_Basics_JudgeDevice_Result = false;  
?>