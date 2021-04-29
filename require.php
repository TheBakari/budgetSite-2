<?php

$folder="";
if(!file_exists($folder."class/classBaza.php"))$folder="../";//odakle god zovem req on vuce sve iz baze 
require_once($folder."class/classBaza.php");//spajanje sa klasama
require_once($folder."function.php");//spajanje sa funkcijama
require_once($folder."class/classLog.php");//klasa za logove


?>