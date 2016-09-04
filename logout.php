<?php
setcookie("user","", time()-3600);
setcookie("token","", time()-3600);
echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
?>