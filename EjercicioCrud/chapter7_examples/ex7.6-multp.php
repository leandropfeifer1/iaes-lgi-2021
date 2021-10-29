<html>
<head>
<title>Looping Constructs</title>
<body bgcolor="lightblue">
<h3>For Loop</h3>
<font face='arial' size='+1'>
<?php
$multiplicador=3;
$rango=10;
echo "tabla del $multiplicador hasta el $rango <br>";
  for( $n = 1; $n <= $rango; $n++ ){
$resultados=$n*$multiplicador;
    echo "$n x $multiplicador = $resultados <br> ";
  }
echo "post bucle";
?>
</head>
<body></body>
</html>
