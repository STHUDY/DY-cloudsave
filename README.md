# DY-cloudsave

兼容移动端

DY云储存(PHP:7.4)

版本:2.1.6

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
      
API-USE(https://api.sthudy.top/)

可自行购买API
  
  API接口->验证码接口->HCJS验证码接口(购买)

或者使用免费账号:

      账号:pneumonoultramicroscopicsilicovo
      密码:リュウグウノオトヒメノモトユイノキリハズシ
      UIC:101655625233194



数据库:

  导入数据库文件：User_Load_info.sql
  
大文件上传不了的解决方法:

  请修改以下配置
  
  PHP(php.ini):
      ==根据服务器配置而定==
      post_max_size(POST数据最大尺寸):2047M
      file_uploads(是否允许上传文件):true
      upload_max_filesize(允许上传文件的最大尺寸):2047M
      max_execution_time(最大脚本运行时间):30000
      memory_limit(脚本内存限制):1280M
  Nginx:
      Client_max_body_size(最大上传文件):2047MB
