<?php
session_start();
require_once("../require.php");

$db=mysqli_connect("localhost", "root", "", "kuvar2");
if(mysqli_connect_error())
{
    echo "Greska sa bazom<br>".mysqli_connect_error();
}
mysqli_query($db, "SET NAMES utf8");
$funkcija=$_GET['funkcija'];

if($funkcija=="update")
{
    $idRecept=$_POST['idRecept'];
    $headRecept=$_POST['headRecept'];
    $descRecept=$_POST['descRecept'];
    $category=$_POST['category'];
    $headTtecept=$_POST['headTtecept'];
    $descTrecept=$_POST['descTrecept'];
    $ingredients=$_POST['ingredients'];
    $instruction=$_POST['instruction'];
    if($idRecept=="" or $headRecept=="" or  $descRecept=="" or $category=="" or $headTtecept=="" or  $descRecept=="" or  $descTrecept=="" or  $ingredients==""  or  $instruction=="")
    {
        echo "Information are missing";
        exit();
    }
        $sql="UPDATE recept SET headRecept='{$headRecept}', descriptionRecept='{$descRecept}',category_idKategorije='{$category}', headerTwoRecept='{$headTtecept}',descriptionTwoRecept='{$descTrecept}', ingredientsRecept='{$ingredients}', instructionRecept='{$instruction}' WHERE idRecept='{$idRecept}'";
        mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong update<br>".mysqli_error($db);
        else
            {
                echo "User added: ".mysqli_affected_rows($db);
                Log::writeLog("../logs/added_recipe.txt","Successfully Changed recipe $headRecept from user{$_SESSION['accNameUsers']}");
            }
        
     }
    if($funkcija=="insert")
{
    
    $headRecept=$_POST['headRecept'];
    $descRecept=$_POST['descRecept'];
    $category=$_POST['category'];
    $headTtecept=$_POST['headTtecept'];
    $descTrecept=$_POST['descTrecept'];
    $ingredients=$_POST['ingredients'];
    $instruction=$_POST['instruction'];
    if( $headRecept=="" or  $descRecept=="" or $category=="" or $headTtecept=="" or  $descRecept=="" or  $descTrecept=="" or  $ingredients==""  or  $instruction=="")
    {
        echo "Information are missing";
        exit();
    }
        $sql="INSERT INTO recept (headRecept,descriptionRecept,category_idKategorije, headerTwoRecept,descriptionTwoRecept,ingredientsRecept,instructionRecept) VALUES('{$headRecept}','{$descRecept}',{$category},'{$headTtecept}','{$descTrecept}','{$ingredients}','{$instruction}')";
        mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong insert<br>".mysqli_error($db);
        else
            {
                echo "User added: ".mysqli_affected_rows($db);
                Log::writeLog("../logs/changed_recipe.txt","Successfully Changed User $accName from user{$_SESSION['accNameUsers']}");
            }
        
    }

    if($funkcija=="delete")
{
    $idRecept=$_POST['idRecept'];
    if($idRecept=="")
    {
        echo "You didn't chose recipe to delete";
    exit();
    }
    $sql="DELETE FROM recept WHERE idRecept={$idRecept}";
    mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong delete<br>".mysqli_error($db);
        else
        {
            echo "RECIPE DELETED ".mysqli_affected_rows($db);
            Log::writeLog("../logs/recipe_delete.txt","Successfully Changed Recept by $accName from user{$_SESSION['accNameUsers']}");
        }
            
    
}

?>