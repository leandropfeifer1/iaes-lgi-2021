<head><title>Looping</title></head>
<body bgcolor="lightgreen">
<font face="arial" size="+1">
<div align="center">
<b>
<?php

  $character = "**";
  echo "*";
  for ($fila=0; $fila < 40; $fila++){
     for ($col=0; $col < $fila; $col++){
        echo $character;
     }
        echo "\n<br />";
   }
     echo "| |\n<br />";
?>
<font color='red'>Merry Christmas!</font></font><br />
</div>
</body>
</html>
