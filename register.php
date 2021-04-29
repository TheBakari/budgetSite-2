<?php
session_start();
require_once("require.php");//poziv iz require.php stranice
if(!login())
{
    echo "You need to me login to see this page.<br>";
    echo "<a href='login.php?link=".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."'>Log in </a>";
    exit();
}
if($_SESSION['statusUsers']!="Administrator")
{
    echo "You need to me login as Administrator to see this page.<br>";
    echo "<a href='login.php'>Log in </a>";
    exit();
}
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon
$poruka="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Java script-->
    
    <link rel="stylesheet" type="text/css" href="icons/css/all.css">
    
    <!--CSS-->
    <link href="css/style_new.css" rel="stylesheet">
    <title>Budget Byte</title>
</head>
<body>
<?php 
        include("_header.php");
    ?>

    <?php
            if(isset($_POST['button_reg']))
            {
                $accName=$_POST['accName'];
                $fName=$_POST['fName'];
                $lName=$_POST['lName'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $status=$_POST['status'];
                if($accName!="" and $fName!="" and $lName!="" and $email!="" and $password!="" and $status!="0" )
                {
                    $upit="INSERT INTO users (accNameUsers,imeUsers,lastNameUsers,emailUsers,passwordUsers,statusUsers) VALUES('{$accName}','{$fName}','{$lName}','{$email}','{$password}','{$status}')";
                    $db->query($upit);
                    if($db->error())$poruka=$db->error();
                    else
                    {
                        $poruka="Successfully Added User $accName";
                        Log::writeLog("logs/userRegistration.txt","Successfully Added User $accName from user{$_SESSION['accNameUsers']}");
                        
                    }
                }
                else
                     $poruka="Please fill all boxes!";
                   
            }
        ?>
    <div class="container">
        <div class="row">
             <div class="col-md-6">
                <h1 class="hrana">Register</h1>
                            <form action="register.php" method="POST" id="logIn">
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                        <input type="text" class="form-control raccname " id="accName" name="accName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control rname " id="fName" name="fName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                        <input type="text" class="form-control rlastname " id="lName" name="lName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" class="form-control remail " id="email" name="email"aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control rpassword" id="password " name="password">
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <select class="form-select status" aria-label="Default select example" id="status" name="status">
                                            <option selected>Chose Status of new User</option>
                                            <option value="Administrator">Admin</option>
                                            <option value="Uradnika">Editor</option>
                                            <option value="Korisnika">User</option>
                                        </select><br><br>
                                    </div>
                                    <button  class="btn btn-warning" name="button_reg">Submit</button>
                            </form>
                            <div><?= $poruka?></div>
                     </div>

            </div>
    </div>
<?php 
     include("_footer.php");
    ?>
</body>