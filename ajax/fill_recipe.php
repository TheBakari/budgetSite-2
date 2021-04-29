<?php 
 $db=mysqli_connect("localhost", "root", "", "kuvar2");
 mysqli_query($db, "SET NAMES UTF8");
 $rez=mysqli_query($db, "SELECT * FROM recept ORDER BY idRecept");
 $sve=mysqli_fetch_all($rez, MYSQLI_ASSOC);// pretvara sve pozive i assoc Niz
 echo JSON_encode($sve, 256);

?>