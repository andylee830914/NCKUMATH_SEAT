<?php
$link=mysql_connect("127.0.0.1","root","") or die ("連線失敗");
mysql_select_db("test");
mysql_set_charset('utf8',$link);
?>