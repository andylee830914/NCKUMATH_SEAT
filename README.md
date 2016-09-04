# NCKUMATH_SEAT

## MySQL Connection
Please make a ```connect.php``` file under the directory. Here is the sample content :
```
<?php
$link=mysql_connect("127.0.0.1","root","mysql_password") or die ("連線失敗");
mysql_select_db("test");
mysql_set_charset('utf8',$link);
?> 
```
