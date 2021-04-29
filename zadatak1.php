<!-- <html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<?php
//Korisnicki napravljena funkcija-
   function pal($a)
   {
       $x=$a;
       $z=strrev($a);
       if(is_string($a))
       {
           if($a!="")
           {
              if($x==$z)
              {
                  return "Rec ".$a." jeste palindrom";
              }
              else
                return "Rec ".$a." nije palindrom";
           }
           else
            return "Niste otkucali nijednu rec!";
       }
       else
        return "Niste otkucali rec nego broj!";
       
   }
   
   $str="anavolimilovana 213123";
   
   echo pal($str);
   
?>

<?php /*
<?php
$numbers = array(4, 6, 2, 22, 11);
rsort($numbers);

$arrlength = count($numbers);
for($x = 0; $x < $arrlength; $x++) {
  echo $numbers[$x];
  echo "<br>";
}
?>
*/
// ?>
// <?php 
//     $a=345243201922;
//     strval($a);
//     $str=$a;
//     echo substr(chunk_split($str,1,","),0,-1);
//     echo "<br>";
//     $broj=array($str);
//     sort($broj);

//     $arrlength = count($broj);
//     for($x = 0; $x < $arrlength; $x++) {
//     echo $broj[$x];
//     echo "<br>";
   
// }

    

// ?>
</body>
</html> -->