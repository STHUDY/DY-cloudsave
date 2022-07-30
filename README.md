# DY-cloudsave

DY云储存

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
     
