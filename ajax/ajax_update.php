<?php
session_start();
require_once("../require.php");

$db=mysqli_connect("localhost","root","","kuvar2");
if(mysqli_connect_error())
{
    echo "Greskaa<br>".mysqli_connect_error();
    exit();
}
mysqli_query($db,"SET NAMES utf8");
$funkcija=$_GET['funkcija'];

if($funkcija=="update")
{
    $idUsers=$_POST['idUsers'];
    $accName=$_POST['accNameUsers'];
    $fName=$_POST['fName'];
    $lName=$_POST['lName'];
    $email=$_POST['email'];
    $status=$_POST['status'];
    $password=$_POST['password'];
    if($idUsers=="" or $accName=="" or $fName=="" or $lName=="" or $email==""  or $status=="0")
    {
        echo " Information are missing ";
        exit();
    }
        $sql="UPDATE users SET  accNameUsers='{$accName}',imeUsers='{$fName}',lastNameUsers='{$lName}',passwordUsers='{$password}',statusUsers='{$status}' WHERE idUsers='{$idUsers}'";
        mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong<br>".mysqli_error($db);
        else
        {
            echo "User added: ".mysqli_affected_rows($db);
            Log::writeLog("../logs/added_user.txt","Successfully Changed User $accName from user{$_SESSION['accNameUsers']}");
        }
            

            

}

if($funkcija=="insert")
{
    
    $accName=$_POST['accNameUsers'];
    $fName=$_POST['fName'];
    $lName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $status=$_POST['status'];
    if($accName=="" or $fName=="" or $lName=="" or $email==""  or $status=="0")
    {
        echo " Information are missing ";
        exit();
    }
        $sql="INSERT INTO users (accNameUsers,imeUsers,lastNameUsers,emailUsers,passwordUsers,statusUsers) VALUES ('{$accName}','{$fName}','{$lName}','{$email}','{$password}','{$status}')";
        mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong<br>".mysqli_error($db);
        else
        {
            echo "User changed: ".mysqli_affected_rows($db);
            Log::writeLog("../logs/changed_user.txt","Successfully Changed User $accName from user{$_SESSION['accNameUsers']}");
        }
            

            

}

if($funkcija=="delete")
{
    $idUsers=$_POST['idUsers'];
    if($idUsers=="")
    {
        echo "You didn't chose user to delete";
    exit();
    }
    $sql="DELETE FROM users WHERE idUsers={$idUsers}";
    mysqli_query($db,$sql);
        if(mysqli_error($db))
            echo "Something went wrong<br>".mysqli_error($db);
        else
        {
            echo "User changed: ".mysqli_affected_rows($db);
            Log::writeLog("../logs/user_delete.txt","Successfully Changed User $accName from user{$_SESSION['accNameUsers']}");
        }
            
    
}
?>