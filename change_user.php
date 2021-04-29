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
    <script src="jscript/jquery-3.5.0.js"></script>
    <link rel="stylesheet" type="text/css" href="icons/css/all.css">
    <script src="jscript/changeUser.js"></script>
    <!--CSS-->
    <link href="css/style_new.css" rel="stylesheet">
    <title>Budget Byte</title>
</head>
<body>
<?php 
        include("_header.php");
    ?>
    <div class="container">
        <div class="row">
        
             <div class="col-md-7">
                <h1 class="hrana">Change User Information</h1>
                                <div class="md-mb-3" id="chose_user">
                                <h5>Chose User</h5>
                                </div>
                                <hr>
                            <form action="change_user.php" method="POST" id="logIn">
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User ID</label>
                                        <input type="text" class="form-control idUsers " id="idUsers" name="idUsers" aria-describedby="emailHelp" disabled > 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                        <input type="text" class="form-control accName " id="accName" name="accName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control fName " id="fName" name="fName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                        <input type="text" class="form-control lName " id="lName" name="lName" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" class="form-control email " id="email" name="email"aria-describedby="emailHelp" > 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control password" id="password " name="password">
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <select class="form-select status" aria-label="Default select example" id="status" name="status">
                                            <option selected>Chose Status of new User</option>
                                            <option value="Administrator">Admin</option>
                                            <option value="Uradnika">Editor</option>
                                            <option value="Korisnika">User</option>
                                        </select><br><br>
                                    </div>
                                 
                            </form>   
                                    <button  class="btn btn-warning" name="button" id="save">Save</button>
                                    <button  class="btn btn-warning" name="button" id="ocisti">Clear</button>
                                    <button  class="btn btn-warning" name="button" id="delete">Delete</button>
                            <div><?= $poruka?></div>
                     </div>

            </div>
    </div>
<?php 
     include("_footer.php");
    ?>
</body>