<?php
//session_start();

session_start();
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon
if(isset($_GET['logout']))
{
   // Log::writeLog("logs/logout.txt","Successful logout for user {$_SESSION['accNameUsers']}");
    destroySession();// cookies je komentarisan u funkcijama php
    
    
}
if(login()){
    header("location:index.php");
}
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
    <script src="jscript/login.js"></script>
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
                <div class="hrana col-md-12">
                    <h2>Login and Registration</h2>
                    <p>Log on or Register  to out site and get some aditional stuff and also be abele to leav comment so we can know if you liked our recipes</p>
                 </div>
                     <div class="col-md-6">
                     <h2 class="hrana"> Log In</h2>
                    <form action="login.php" method="post" >
                            <div class="md-mb-3">
                                <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                <input type="text" class="form-control accName " id="accName" name="accName" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div><br><br>
                            <div class="md-mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control password" id="password" name="password">
                            </div><br><br>
                            
                            
                    </form>
                   <button type="submit" class="btn btn-warning" id="btnPrijava">Log In</button>
                     </div>
                     <div class="col-md-6">
                     <h2 class="hrana"> Registration</h2>
                            <form action="login.php" method="post" id="registration">
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Account Name</label>
                                        <input type="text" class="form-control raccname " id="raccname" name="raccname" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control rname " id="rname" name="rname" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                        <input type="text" class="form-control rlastname " id="rlastname" name="rlastname" aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" class="form-control remail " id="remail" name="remail"aria-describedby="emailHelp"> 
                                    </div><br><br>
                                    <div class="md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control rpassword" id="rpassword " name="rpassword">
                                    </div><br><br>
                                    
                                    <button type="button" class="btn btn-warning" id="btnRegistracija">Submit</button>
                            </form>
                     </div>
                
            </div>
        </div>

        <div id="poruka"></div>
    <?php 
     include("_footer.php");
    ?>
</body>
