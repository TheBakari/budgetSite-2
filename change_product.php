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
    <script src="jscript/changeRecipe.js"></script>
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
             <div class="col-md-6">
                <h1 class="hrana">Change/Add Recipe</h1>
                     <div class="md-mb-3" id="chose_product">
                                <h5>Chose Recipe</h5>
                                </div>
                            <form action="#" method="POST" enctype="multipart/form-data" name="forma">
                                    <!-- id recepta -->
                                     <div class="col-md-mb-3">                    
                                        <label  class="form-label">ID Recipe</label>
                                        <input readonly="readonly" type="text" class="form-control idRecept "name="idRecept" id="idRecept" aria-describedby="emailHelp" > 
                                    </div><br><br>
                                    <!-- header recepta -->
                                    <div class="col-md-mb-3">
                                        <label  class="form-label">Header</label>
                                        <input type="text" class="form-control headRecept " id="headRecept" name="headRecept" aria-describedby="emailHelp"> 
                                    </div><br><br>

                                    <div class="form-group col-md-mb-3">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" name="descriptionRecept"  id="descriptionRecept" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleFormControlTextarea1">Category for Recipe</label><br><br>
                                        <select class="form-select category" aria-label="Default select example"  name="category"  id="category" >
                                        <option value="0">--Choosee category--</option>
                                                <option value="1">Breakfest</option>
                                                <option value="2">Lunch</option>
                                                <option value="5">Dinner</option>
                                                <option value="8">Desert</option>
                                                <option value="9">Meat</option>
                                                <option value="10">Pasta</option>
                                                <option value="13">Pizza</option>
                                                <option value="16">Salad</option>
                                                <option value="18">Vegan</option>
                                        </select>
                                    </div><br><br>
                                    <div class="col-md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Second Header</label>
                                        <input type="text" class="form-control headTwoRecept " name="headTwoRecept" id="headTwoRecept" aria-describedby="emailHelp"> 
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Second Description</label>
                                        <textarea class="form-control descriptionTwoRecept" name="descriptionTwoRecept"  id="descriptionTwoRecept" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Ingredients</label>
                                        <textarea class="form-control ingredients" name="ingredients"  id="ingredients" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Instructions</label>
                                        <textarea class="form-control instruction" name="instruction"  id="instruction" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="formFile" class="form-label">Chose Picture</label>
                                        <input class="form-control slike" type="file" id="slike" name="slike"> 
                                    </div><br><br>

                                    
                            </form>
                            <button  class="btn btn-warning" name="button" id="save">Save</button>
                                    <button  class="btn btn-warning" name="button" id="ocisti">Clear</button>
                                    <button  class="btn btn-warning" name="button" id="delete">Delete</button>
                            <div id="odgovor"></div>
                     </div>

            </div>
    </div>
<?php 
     include("_footer.php");
    ?>
</body> 