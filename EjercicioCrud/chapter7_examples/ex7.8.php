<html><head><title>Breaking out of Loops</title></head>
<body bgcolor="white">
<p>
<table border="1" bordercolor="white" cellpadding="3">
<bgcolor='yellow'>
<caption><font color="white">Freezing Cold!</font></caption>
<tr><th>Celsius</th><th>Farenheit</th><tr>
<?php

  $C=-10;
  while($C < 20){
    $F = ( $C * 1.8) + 32;
    print "<tr><td><b>$C</td><td><b>$F</td>";
    if ( $F == 32 ){ //Break out of loop
       break;
    }
    $C+=1;
  }

?>
</tr>
</table>
</body>
</html>
