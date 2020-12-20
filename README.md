# comic
comic &amp; novel 


伪静态的写法（Nginx环境，宝塔面板）：
location /Mh/{ 
  if (!-e $request_filename) { 
    rewrite ^/Mh/([0-9]+)/([0-9]+).html$ /index.php?m=&c=Mh&a=inforedit&mhid=$1&ji_no=$2 last; 
    rewrite ^/Mh/([0-9]+).html$ /index.php?m=&c=Mh&a=bookinfo&mhid=$1 last;
    rewrite ^/Mh/mhlist/cate/([0-9]+).html$ /index.php?m=&c=Mh&a=mhlist&cate=$1 last;
    rewrite ^/Mh/(.*)$ /index.php/Mh/$1 last;
   
    break; 
    } 
  }
  location /Book/{ 
  if (!-e $request_filename) { 
    rewrite ^/Book/([0-9]+)/([0-9]+).html$ /index.php?m=&c=Book&a=inforedit&bid=$1&ji_no=$2 last; 
    rewrite ^/Book/([0-9]+).html$ /index.php?m=&c=Book&a=bookinfo&bid=$1 last;
    rewrite ^/Book/cate/([0-9]+).html$ /index.php?m=&c=Book&a=booklist&cate=$1 last;
    rewrite ^/Book/(.*)$ /index.php/Book/$1 last;
   
    break; 
    } 
  }
  
  location /Yook/{ 
  if (!-e $request_filename) { 
    rewrite ^/Yook/([0-9]+)/([0-9]+).html$ /index.php?m=&c=Yook&a=inforedit&yid=$1&ji_no=$2 last; 
    rewrite ^/Yook/([0-9]+).html$ /index.php?m=&c=Yook&a=bookinfo&yid=$1 last;
    rewrite ^/Yook/cate/([0-9]+).html$ /index.php?m=&c=Yook&a=booklist&cate=$1 last;
    rewrite ^/Yook/(.*)$ /index.php/Yook/$1 last;
   
    break; 
    } 
  }
  
  location /{
     if (!-e $request_filename) { 
      rewrite ^/(.*)$ /index.php/$1 last;
      break; 
     }
  }

只把公开对读者的部分伪静态化，代理和管理员的还是保持原样。
