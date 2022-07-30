# DY-cloudsave

DY云储存(PHP:7.4)

预览官网:http://pan.sthudy.top/


安装方法:打开install.php进行安装

伪静态:

      location / { 
         if (!-e $request_filename) {
         	rewrite  ^(.*)$  /index.php/=/$1  last;
         	break;
         }
      }
      location /User { 
          rewrite  ^(.*)$  /index.php/=Error  last;
         	break;
      }
      
API-USE

      账号:pneumonoultramicroscopicsilicovo
      密码:リュウグウノオトヒメノモトユイノキリハズシ
      UIC:101655625233194

购买API 

数据库:

      导入数据库文件：User_Load_info.sql
