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

## MySQL table
```
DROP TABLE IF EXISTS `seat`;

CREATE TABLE `seat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `seat` int(11) DEFAULT NULL,
  `allow` tinyint(1) DEFAULT '1',
  `room` int(3) DEFAULT '416',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
