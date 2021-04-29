<?php
//session_start();
if(!isset($_SESSION)){
    session_start();
}   
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon

?>
<header>
    <div class="container"> 
        <!-- log i sreach bar-->
        <div class="row" id="">
            <div class="col-md-6 " id="logo">
               <a href="index.php"><img class="img-fluid" src="images/logo.jpg" alt="logo"></a> 
            </div>
                   <!-- <div class="col-4" class="topSm" id="Smtop"> </div>-->
                            
                   
            <div class="col-md-6 mt-5">
                <div class='row'>
                            <a href="#" class="topSm"> <i class="fa fa-rss"></i></a>
                            <a href="#" class="topSm"> <i class="fab fa-twitter"></i></a>
                            <a href="#" class="topSm"> <i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="topSm"> <i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="topSm"> <i class="fab fa-instagram"></i></a>
            
            <form class="form-inline my-2 my-lg-0 form" method="POST" action="search">
                <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="search" id="search">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
            </div>
        </div>
        <hr>
        <!--NAV MENio--->
        <nav class="navbar navbar-expand-lg navbar-light row" id="navBar">
  
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="homePage">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Recipes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                                $html="";
                                        $upit="SELECT * FROM category";
                                        $rez=$db->query($upit);
                                        while($red=$db->fetch_object($rez)){
                                            //  echo "<pre>";
                                            //  print_r($rez);
                                            //  echo "</pre>";
                                           // $html.="<a class='dropdown-item' href='recipes.php?category=$red->idKategorije'>$red->nameKategorije</a>";
                                            $html.="<a class='dropdown-item' href='category=$red->idKategorije '>$red->nameKategorije</a>";
                                        }
                                    echo $html;  
                        ?>
                       
                        
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="AboutMe">About Me</a>
                        <a class="dropdown-item" href="contactus">Contact Us</a>
                        <a class="dropdown-item" href="Terms&Condition">Terms & Condition</a>
                        <a class="dropdown-item" href="PrivacyPolicy">Privacy Policy</a>
</div>
                    
                    <li class="nav-item dropdown "> 
                        <!-- <a class="nav-link " href="login.php" tabindex="-1" aria-disabled="true">Login</a>   -->
                        <?php 
                            if(login()){
                                 echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>{$_SESSION['accNameUsers']} ({$_SESSION['statusUsers']})</a>";
                                 echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' ";
                                 if($_SESSION['statusUsers']=='Administrator'){
                                     echo "<a class='dropdown-item' href='#'>Administrator</a>";
                                     echo "<a class='dropdown-item' href='register.php?register'>Registration</a>";
                                     echo "<a class='dropdown-item' href='change_user.php'>Change User</a>";
                                     echo "<a class='dropdown-item' href='add_product.php'>Add product</a>";
                                     echo "<a class='dropdown-item' href='change_product.php'>Change product</a>";
                                     echo "<a class='dropdown-item' href='statistic.php'>Statistic</a>";
                                     echo "<a class='dropdown-item' href='comments.php'>Comments</a>";
                                     echo "<a class='dropdown-item' href='question.php'>Question</a>";
                                     echo "<a class='dropdown-item' href='login?logout'>Logout</a>";
                                     echo "</div>";
                              } else if($_SESSION['statusUsers']=="Korisnika"){
                                echo "<a class='dropdown-item' href=''>User</a>";
                                echo "<a class='dropdown-item' href='login?logout'>Logout</a>";
                              }else if($_SESSION['statusUsers']=="Editor"){
                                echo "<a class='dropdown-item' href=''>Editor</a>";
                                echo "<a class='dropdown-item' href='comments.php'>Comments</a>";
                                echo "<a class='dropdown-item' href='question.php'>Question</a>";
                                echo "<a class='dropdown-item' href='login?logout'>Logout</a>";
                              }
                            
                            }
                            else{
                                echo "<a class='nav-link ' href='login' tabindex='-1' aria-disabled='true' >Login</a>";
                              }
                        ?>
                        
                    </li>
                    </ul>
                    
                </div>
        </nav>
        <hr>
    </div>
</header>